<?php

namespace Tests\Feature;

use App\Mail\AuditRequestConfirmation;
use App\Mail\NewAuditRequestNotification;
use App\Models\AuditRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Mockery;
use PHPUnit\Framework\Attributes\DataProvider;
use RuntimeException;
use Tests\TestCase;

class AuditRequestFlowTest extends TestCase
{
    use RefreshDatabase;

    private bool $turnstileSucceeds = true;

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.local_works.intake_email' => 'intake@local.test']);
        config([
            'services.turnstile.site_key' => 'test-site-key',
            'services.turnstile.secret_key' => 'test-secret',
        ]);
        Http::fake([
            'https://challenges.cloudflare.com/turnstile/v0/siteverify' => fn () => Http::response([
                'success' => $this->turnstileSucceeds,
            ]),
        ]);
        Mail::fake();
    }

    public function test_valid_request_is_stored_notified_and_redirected_to_truthful_confirmation(): void
    {
        $response = $this->post(route('audit-requests.store'), $this->validData());

        $response->assertRedirect(route('thank-you'));
        $this->assertDatabaseHas('audit_requests', [
            'name' => 'Avery Owner',
            'email' => 'avery@example.com',
            'business_name' => 'Example Workshop',
            'business_website' => 'https://example.com',
            'friction_description' => 'Customers must call to make routine changes.',
            'status' => AuditRequest::STATUS_NEW,
        ]);
        Mail::assertSent(NewAuditRequestNotification::class, fn ($mail): bool => $mail->hasTo('intake@local.test') && $mail->auditRequest->business_name === 'Example Workshop'
        );
        Mail::assertSent(AuditRequestConfirmation::class, function ($mail): bool {
            return $mail->hasTo('avery@example.com')
                && $mail->envelope()->subject === 'We received your Digital Friction Audit request'
                && str_contains($mail->render(), 'Hello Avery Owner,')
                && str_contains($mail->render(), 'Customers must call to make routine changes.')
                && str_contains($mail->render(), 'A staff member takes the call and updates the system.');
        });
        Http::assertSent(fn ($request): bool => $request->url() === 'https://challenges.cloudflare.com/turnstile/v0/siteverify'
            && $request['secret'] === 'test-secret'
            && $request['response'] === 'valid-test-token'
            && filled($request['remoteip']));

        $this->followRedirects($response)
            ->assertOk()
            ->assertSee('Your request has been received.')
            ->assertSee('data-submission-event="audit_form_submit"', false);
    }

    public function test_form_renders_the_turnstile_widget_and_script(): void
    {
        $this->get(route('digital-friction-audit'))
            ->assertOk()
            ->assertSee('class="cf-turnstile"', false)
            ->assertSee('data-sitekey="test-site-key"', false)
            ->assertSee('https://challenges.cloudflare.com/turnstile/v0/api.js', false);
    }

    #[DataProvider('requiredFields')]
    public function test_required_fields_are_validated(string $field, mixed $value): void
    {
        $response = $this->from(route('digital-friction-audit'))
            ->post(route('audit-requests.store'), array_merge($this->validData(), [$field => $value]));

        $response->assertRedirect(route('digital-friction-audit').'#audit-intake')->assertSessionHasErrors($field);
        $this->assertDatabaseCount('audit_requests', 0);
        Mail::assertNothingSent();
    }

    public static function requiredFields(): array
    {
        return [
            'name required' => ['name', ''],
            'email required' => ['email', ''],
            'email valid' => ['email', 'not-an-email'],
            'business name required' => ['business_name', ''],
            'friction required' => ['friction_description', ''],
            'current process required' => ['current_process', ''],
        ];
    }

    public function test_optional_fields_are_optional_and_website_is_conservatively_normalized(): void
    {
        $data = $this->validData();
        $data['business_website'] = 'example.org/about';

        $this->post(route('audit-requests.store'), $data)->assertRedirect(route('thank-you'));
        $this->assertDatabaseHas('audit_requests', ['business_website' => 'https://example.org/about']);
    }

    public function test_validation_repopulates_inputs_and_textareas_with_field_errors(): void
    {
        $response = $this->followingRedirects()->from(route('digital-friction-audit'))
            ->post(route('audit-requests.store'), array_merge($this->validData(), ['email' => 'invalid']));

        $response->assertSee('value="Avery Owner"', false)
            ->assertSee('Customers must call to make routine changes.')
            ->assertSee('id="email-error"', false)
            ->assertSee('aria-invalid="true"', false);
    }

    public function test_first_touch_attribution_is_preserved_across_navigation(): void
    {
        $this->withHeader('Referer', 'https://linkedin.com/feed')
            ->get('/?utm_source=linkedin&utm_medium=social&utm_campaign=launch');
        $this->get('/digital-friction-audit?utm_source=overwritten');
        $this->post(route('audit-requests.store'), $this->validData());

        $this->assertDatabaseHas('audit_requests', [
            'utm_source' => 'linkedin',
            'utm_medium' => 'social',
            'utm_campaign' => 'launch',
            'landing_page' => '/',
            'referrer' => 'https://linkedin.com/feed',
        ]);
    }

    public function test_honeypot_submission_is_rejected_without_storage_or_mail(): void
    {
        $response = $this->from(route('digital-friction-audit'))->post(
            route('audit-requests.store'),
            array_merge($this->validData(), ['company_fax' => 'bot content'])
        );

        $response->assertRedirect(route('digital-friction-audit').'#audit-intake')->assertSessionHasErrors('company_fax');
        $this->assertDatabaseCount('audit_requests', 0);
        Mail::assertNothingSent();
        Http::assertNothingSent();
    }

    public function test_failed_turnstile_verification_prevents_storage_and_mail(): void
    {
        $this->turnstileSucceeds = false;

        $this->from(route('digital-friction-audit'))->post(route('audit-requests.store'), $this->validData())
            ->assertRedirect(route('digital-friction-audit').'#audit-intake')
            ->assertSessionHasErrors(['cf-turnstile-response' => "We couldn't verify your submission. Please try again."]);

        $this->assertDatabaseCount('audit_requests', 0);
        Mail::assertNothingSent();
    }

    public function test_missing_turnstile_response_is_rejected_without_verification_or_side_effects(): void
    {
        $data = $this->validData();
        unset($data['cf-turnstile-response']);

        $this->from(route('digital-friction-audit'))->post(route('audit-requests.store'), $data)
            ->assertSessionHasErrors('cf-turnstile-response');

        $this->assertDatabaseCount('audit_requests', 0);
        Mail::assertNothingSent();
        Http::assertNothingSent();
    }

    public function test_submission_route_is_rate_limited_but_validation_mistakes_allow_retries(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('audit-requests.store'), [])->assertSessionHasErrors();
        }

        $this->post(route('audit-requests.store'), [])->assertTooManyRequests();
    }

    public function test_direct_thank_you_access_redirects_without_false_confirmation(): void
    {
        $this->get('/thank-you')->assertRedirect(route('digital-friction-audit'));
    }

    public function test_success_analytics_marker_is_server_confirmed_and_one_time(): void
    {
        $this->post(route('audit-requests.store'), $this->validData())->assertRedirect(route('thank-you'));

        $this->get(route('thank-you'))
            ->assertOk()
            ->assertSee('data-analytics-success-event="audit_form_submit"', false);
        $this->get(route('thank-you'))->assertRedirect(route('digital-friction-audit'));

        $this->followingRedirects()
            ->from(route('digital-friction-audit'))
            ->post(route('audit-requests.store'), array_merge($this->validData(), ['email' => 'invalid']))
            ->assertDontSee('data-analytics-success-event="audit_form_submit"', false);
    }

    public function test_internal_mail_failure_does_not_discard_request_or_prevent_confirmation(): void
    {
        $confirmation = Mockery::mock();
        $confirmation->shouldReceive('send')->once()->with(Mockery::type(AuditRequestConfirmation::class));
        Mail::shouldReceive('to')->once()->with('intake@local.test')->andThrow(new RuntimeException('Transport unavailable'));
        Mail::shouldReceive('to')->once()->with('avery@example.com')->andReturn($confirmation);

        $this->post(route('audit-requests.store'), $this->validData())
            ->assertRedirect(route('thank-you'));

        $this->assertDatabaseHas('audit_requests', [
            'email' => 'avery@example.com',
            'status' => AuditRequest::STATUS_NEW,
        ]);
    }

    public function test_confirmation_mail_failure_does_not_discard_request_or_prevent_internal_notification(): void
    {
        $notification = Mockery::mock();
        $notification->shouldReceive('send')->once()->with(Mockery::type(NewAuditRequestNotification::class));
        Mail::shouldReceive('to')->once()->with('intake@local.test')->andReturn($notification);
        Mail::shouldReceive('to')->once()->with('avery@example.com')->andThrow(new RuntimeException('Transport unavailable'));

        $this->post(route('audit-requests.store'), $this->validData())->assertRedirect(route('thank-you'));

        $this->assertDatabaseHas('audit_requests', ['email' => 'avery@example.com', 'status' => AuditRequest::STATUS_NEW]);
    }

    public function test_no_public_audit_request_browsing_routes_exist(): void
    {
        $this->assertFalse(Route::has('audit-requests.index'));
        $this->assertFalse(Route::has('audit-requests.show'));
        $this->get('/audit-requests')->assertNotFound();
    }

    private function validData(): array
    {
        return [
            'name' => 'Avery Owner',
            'email' => 'avery@example.com',
            'business_name' => 'Example Workshop',
            'business_website' => 'example.com',
            'friction_description' => 'Customers must call to make routine changes.',
            'current_process' => 'A staff member takes the call and updates the system.',
            'cf-turnstile-response' => 'valid-test-token',
        ];
    }
}

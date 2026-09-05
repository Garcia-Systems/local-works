<?php

namespace Tests\Feature;

use App\Mail\NewContactRequestNotification;
use App\Models\ContactRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\DataProvider;
use RuntimeException;
use Tests\TestCase;

class ContactRequestFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.local_works.intake_email' => 'intake@local.test']);
        Mail::fake();
    }

    public function test_valid_message_is_stored_notified_and_redirected_to_truthful_confirmation(): void
    {
        $response = $this->post(route('contact-requests.store'), $this->validData());

        $response->assertRedirect(route('contact.thank-you'));
        $this->assertDatabaseHas('contact_requests', [
            'name' => 'Avery Owner',
            'email' => 'avery@example.com',
            'business_name' => 'Example Workshop',
            'message' => 'I have a general question about Local Works.',
            'status' => ContactRequest::STATUS_NEW,
        ]);
        Mail::assertSent(NewContactRequestNotification::class, fn ($mail): bool => $mail->hasTo('intake@local.test') && $mail->contactRequest->email === 'avery@example.com'
        );
        $this->followRedirects($response)->assertOk()
            ->assertSee('Your message has been received.')
            ->assertSee('data-submission-event="contact_form_submit"', false);
    }

    #[DataProvider('requiredFields')]
    public function test_required_fields_are_validated(string $field, mixed $value): void
    {
        $this->from(route('contact'))->post(route('contact-requests.store'), array_merge($this->validData(), [$field => $value]))
            ->assertRedirect(route('contact').'#general-contact')->assertSessionHasErrors($field);
        $this->assertDatabaseCount('contact_requests', 0);
        Mail::assertNothingSent();
    }

    public static function requiredFields(): array
    {
        return [
            'name required' => ['name', ''],
            'email required' => ['email', ''],
            'email valid' => ['email', 'not-an-email'],
            'message required' => ['message', ''],
        ];
    }

    public function test_optional_fields_are_optional_and_validation_repopulates_the_form(): void
    {
        $data = $this->validData();
        unset($data['phone'], $data['business_name']);
        $this->post(route('contact-requests.store'), $data)->assertRedirect(route('contact.thank-you'));

        $this->followingRedirects()->from(route('contact'))
            ->post(route('contact-requests.store'), array_merge($this->validData(), ['email' => 'invalid']))
            ->assertSee('value="Avery Owner"', false)
            ->assertSee('I have a general question about Local Works.')
            ->assertSee('id="contact-email-error"', false)
            ->assertSee('aria-invalid="true"', false);
    }

    public function test_first_touch_attribution_is_preserved(): void
    {
        $this->withHeader('Referer', 'https://example.org/referral')
            ->get('/about?utm_source=referral&utm_campaign=introduction');
        $this->get('/contact?utm_source=overwritten');
        $this->post(route('contact-requests.store'), $this->validData());

        $this->assertDatabaseHas('contact_requests', [
            'utm_source' => 'referral',
            'utm_campaign' => 'introduction',
            'landing_page' => '/about',
            'referrer' => 'https://example.org/referral',
        ]);
    }

    public function test_honeypot_and_rate_limit_protect_the_form(): void
    {
        $this->from(route('contact'))->post(route('contact-requests.store'), array_merge($this->validData(), ['company_fax' => 'bot']))
            ->assertRedirect(route('contact').'#general-contact')->assertSessionHasErrors('company_fax');
        $this->assertDatabaseCount('contact_requests', 0);
        Mail::assertNothingSent();

        for ($attempt = 0; $attempt < 4; $attempt++) {
            $this->post(route('contact-requests.store'), [])->assertSessionHasErrors();
        }
        $this->post(route('contact-requests.store'), [])->assertTooManyRequests();
    }

    public function test_confirmation_is_gated_and_records_are_not_public(): void
    {
        $this->get(route('contact.thank-you'))->assertRedirect(route('contact'));
        $this->assertFalse(Route::has('contact-requests.index'));
        $this->assertFalse(Route::has('contact-requests.show'));
        $this->get('/contact-requests')->assertNotFound();
    }

    public function test_success_analytics_marker_is_server_confirmed_and_one_time(): void
    {
        $this->post(route('contact-requests.store'), $this->validData())->assertRedirect(route('contact.thank-you'));

        $this->get(route('contact.thank-you'))
            ->assertOk()
            ->assertSee('data-analytics-success-event="contact_form_submit"', false);
        $this->get(route('contact.thank-you'))->assertRedirect(route('contact'));

        $this->followingRedirects()
            ->from(route('contact'))
            ->post(route('contact-requests.store'), array_merge($this->validData(), ['email' => 'invalid']))
            ->assertDontSee('data-analytics-success-event="contact_form_submit"', false);
    }

    public function test_mail_failure_does_not_discard_the_message(): void
    {
        Mail::shouldReceive('to')->once()->andThrow(new RuntimeException('Transport unavailable'));
        $this->post(route('contact-requests.store'), $this->validData())->assertRedirect(route('contact.thank-you'));
        $this->assertDatabaseHas('contact_requests', ['email' => 'avery@example.com', 'status' => ContactRequest::STATUS_NEW]);
    }

    private function validData(): array
    {
        return ['name' => 'Avery Owner', 'email' => 'avery@example.com', 'phone' => '555-0100', 'business_name' => 'Example Workshop', 'message' => 'I have a general question about Local Works.'];
    }
}

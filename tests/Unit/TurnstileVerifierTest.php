<?php

namespace Tests\Unit;

use App\Services\TurnstileVerifier;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class TurnstileVerifierTest extends TestCase
{
    private const VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    protected function setUp(): void
    {
        parent::setUp();

        config(['services.turnstile.secret_key' => 'test-secret']);
    }

    public function test_it_accepts_only_a_strict_boolean_true_from_the_exact_siteverify_endpoint(): void
    {
        Http::fake([self::VERIFY_URL => Http::response(['success' => true])]);

        $this->assertTrue(app(TurnstileVerifier::class)->verify('test-token', '192.0.2.1'));

        Http::assertSent(fn ($request): bool => $request->url() === self::VERIFY_URL
            && $request['secret'] === 'test-secret'
            && $request['response'] === 'test-token'
            && $request['remoteip'] === '192.0.2.1');
    }

    #[DataProvider('failedResponses')]
    public function test_it_fails_closed_for_unsuccessful_or_unexpected_responses(mixed $body, int $status = 200): void
    {
        Http::fake([self::VERIFY_URL => Http::response($body, $status)]);

        $this->assertFalse(app(TurnstileVerifier::class)->verify('test-token'));
    }

    public static function failedResponses(): array
    {
        return [
            'boolean false' => [['success' => false]],
            'integer zero' => [['success' => 0]],
            'string false' => [['success' => 'false']],
            'missing success' => [[]],
            'unexpected scalar' => ['unexpected'],
            'non-2xx response' => [['success' => true], 500],
        ];
    }

    public function test_it_fails_closed_for_invalid_json(): void
    {
        Http::fake([self::VERIFY_URL => Http::response('{invalid-json')]);

        $this->assertFalse(app(TurnstileVerifier::class)->verify('test-token'));
    }

    public function test_it_fails_closed_for_network_exceptions(): void
    {
        Http::fake(fn () => throw new ConnectionException('Connection failed'));

        $this->assertFalse(app(TurnstileVerifier::class)->verify('test-token'));
    }

    #[DataProvider('missingCredentials')]
    public function test_it_does_not_send_a_request_when_a_credential_is_missing(?string $secret, string $token): void
    {
        config(['services.turnstile.secret_key' => $secret]);
        Http::fake();

        $this->assertFalse(app(TurnstileVerifier::class)->verify($token));
        Http::assertNothingSent();
    }

    public static function missingCredentials(): array
    {
        return [
            'missing secret' => [null, 'test-token'],
            'empty secret' => ['', 'test-token'],
            'blank secret' => ['   ', 'test-token'],
            'missing token' => ['test-secret', ''],
            'blank token' => ['test-secret', '   '],
        ];
    }
}

<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    public function test_application_boots_with_local_works_identity(): void
    {
        $this->get('/')->assertOk()->assertSee('LOCAL WORKS')->assertSee('by Garcia Systems');
    }

    #[DataProvider('publicRoutes')]
    public function test_public_marketing_routes_are_successful_without_authentication(string $uri, string $heading): void
    {
        $this->get($uri)
            ->assertOk()
            ->assertSee($heading)
            ->assertDontSee('Log in')
            ->assertDontSee('Register');
    }

    public static function publicRoutes(): array
    {
        return [
            'home' => ['/', 'Make your business easier to use.'],
            'how it works' => ['/how-it-works', 'Start with the problem, not the software.'],
            'audit' => ['/digital-friction-audit', 'Find the friction worth fixing.'],
            'problems' => ['/problems', 'Everyday work should not be this hard.'],
            'about' => ['/about', 'Practical business improvement, locally grounded.'],
            'insights' => ['/insights', 'Notes on simpler business operations.'],
            'contact' => ['/contact', 'Start a conversation.'],
            'privacy' => ['/privacy', 'Privacy matters.'],
            'thank you' => ['/thank-you', 'Thank you.'],
        ];
    }
}

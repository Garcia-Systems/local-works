<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    public function test_application_boots_with_local_works_identity(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('LOCAL WORKS')
            ->assertSee('by Garcia Systems')
            ->assertSee('Make your business easier to use.')
            ->assertSee('href="'.route('digital-friction-audit').'"', false);
    }

    public function test_public_navigation_contains_expected_destinations_and_mobile_controls(): void
    {
        $response = $this->get('/problems');

        foreach (['how-it-works', 'digital-friction-audit', 'problems', 'about', 'insights'] as $routeName) {
            $response->assertSee('href="'.route($routeName).'"', false);
        }

        $response
            ->assertSee('aria-label="Primary navigation"', false)
            ->assertSee('aria-controls="mobile-navigation"', false)
            ->assertSee('aria-expanded="false"', false)
            ->assertSee('aria-current="page"', false);
    }

    #[DataProvider('publicRoutes')]
    public function test_public_marketing_routes_are_successful_without_authentication(string $uri, string $heading): void
    {
        $this->get($uri)
            ->assertOk()
            ->assertSee($heading)
            ->assertSee('LOCAL WORKS')
            ->assertSee('Helping businesses find and remove unnecessary friction')
            ->assertSee('<main id="main-content">', false)
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

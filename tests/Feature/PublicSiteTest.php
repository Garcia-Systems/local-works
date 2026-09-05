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

    public function test_homepage_presents_the_audit_path_and_decision_method(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('<h1 id="home-title"', false)
            ->assertSee('Make your business easier to use.')
            ->assertSee('Not every problem needs custom software.')
            ->assertSeeInOrder(['Observe', 'Understand', 'Measure', 'Choose', 'Deliver'])
            ->assertSeeInOrder(['Configure', 'Integrate', 'Automate', 'Custom Build', 'Leave Alone'])
            ->assertSee('data-cta-location="hero"', false)
            ->assertSee('data-cta-location="audit-section"', false)
            ->assertSee('data-cta-location="final-cta"', false)
            ->assertSee('href="'.route('digital-friction-audit').'"', false)
            ->assertSee('What’s harder about doing business with you than it needs to be?')
            ->assertDontSee('Log in')
            ->assertDontSee('Register');
    }

    public function test_homepage_does_not_present_fabricated_proof_or_an_audit_form(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertDontSee('Trusted by')
            ->assertDontSee('customers served')
            ->assertDontSee('guaranteed savings')
            ->assertDontSee('<form', false)
            ->assertDontSee('name="email"', false);
    }

    public function test_how_it_works_explains_the_complete_methodology_and_decisions(): void
    {
        $response = $this->get('/how-it-works');

        $response
            ->assertOk()
            ->assertSee('<h1 id="page-title"', false)
            ->assertSee('Start with how the work actually gets done.')
            ->assertSeeInOrder(['1. Observe', '2. Understand', '3. Measure', '4. Choose', '5. Deliver'])
            ->assertSeeInOrder(['Configure', 'Integrate', 'Automate', 'Custom Build', 'Leave Alone'])
            ->assertSee('Observation is not proof.')
            ->assertSee('Example scenario')
            ->assertSee('hypothetical appointment request', false)
            ->assertSee('href="'.route('digital-friction-audit').'"', false)
            ->assertDontSee('Log in')
            ->assertDontSee('Register');
    }

    public function test_audit_page_explains_the_investigation_and_renders_the_intake(): void
    {
        $response = $this->get('/digital-friction-audit');

        $response
            ->assertOk()
            ->assertSee('Find what is harder than it needs to be.')
            ->assertSeeInOrder(['Find', 'Understand', 'Contact', 'Book / Join', 'Pay', 'Receive Service', 'Manage', 'Return'])
            ->assertSeeInOrder(['Observed fact', 'Possible friction', 'Unknowns', 'Questions', 'Evidence', 'Decision'])
            ->assertSeeInOrder(['Configure', 'Integrate', 'Automate', 'Custom Build', 'Leave Alone'])
            ->assertSee('Hypothetical examples')
            ->assertSee('not Local Works customer stories')
            ->assertSee('href="'.route('how-it-works').'"', false)
            ->assertSee('href="'.route('privacy').'"', false)
            ->assertSee('data-page="digital-friction-audit"', false)
            ->assertSee('data-analytics-form="audit-request"', false)
            ->assertDontSee('Log in')
            ->assertDontSee('Register');
    }

    public function test_audit_intake_is_accessible_and_posts_to_the_submission_route(): void
    {
        $response = $this->get('/digital-friction-audit');

        foreach (['name', 'email', 'phone', 'business_name', 'business_website', 'business_type', 'business_location', 'friction_description', 'current_process', 'desired_improvement', 'additional_context'] as $field) {
            $response->assertSee('name="'.$field.'"', false);
        }

        $response
            ->assertSee('type="email"', false)
            ->assertSee('type="tel"', false)
            ->assertSee('action="'.route('audit-requests.store').'" method="POST"', false)
            ->assertSee('name="name" type="text" autocomplete="name" required aria-required="true"', false)
            ->assertSee('name="email" type="email" inputmode="email" autocomplete="email" required aria-required="true"', false)
            ->assertSee('name="business_name" type="text" autocomplete="organization" required aria-required="true"', false)
            ->assertSee('name="friction_description" rows="5" required aria-required="true"', false)
            ->assertSee('name="current_process" rows="5" required aria-required="true"', false)
            ->assertSee('name="_token"', false)
            ->assertDontSee('type="submit" disabled', false)
            ->assertDontSee('request received', false);
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
            'how it works' => ['/how-it-works', 'Start with how the work actually gets done.'],
            'audit' => ['/digital-friction-audit', 'Find what is harder than it needs to be.'],
            'problems' => ['/problems', 'Everyday work should not be this hard.'],
            'about' => ['/about', 'Practical business improvement, locally grounded.'],
            'insights' => ['/insights', 'Notes on simpler business operations.'],
            'contact' => ['/contact', 'Start a conversation.'],
            'privacy' => ['/privacy', 'Privacy matters.'],
        ];
    }
}

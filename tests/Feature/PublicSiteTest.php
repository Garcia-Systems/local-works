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
            ->assertSee('data-analytics-location="home_hero"', false)
            ->assertSee('data-analytics-location="home_audit_section"', false)
            ->assertSee('data-analytics-location="home_final_cta"', false)
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
            ->assertSee('name="_token"', false)
            ->assertDontSee('type="submit" disabled', false)
            ->assertDontSee('request received', false);

        $this->assertControlHasAttributes($response->getContent(), 'input', ['name' => 'name', 'type' => 'text', 'autocomplete' => 'name', 'required' => null, 'aria-required' => 'true']);
        $this->assertControlHasAttributes($response->getContent(), 'input', ['name' => 'email', 'type' => 'email', 'inputmode' => 'email', 'autocomplete' => 'email', 'required' => null, 'aria-required' => 'true']);
        $this->assertControlHasAttributes($response->getContent(), 'input', ['name' => 'business_name', 'type' => 'text', 'autocomplete' => 'organization', 'required' => null, 'aria-required' => 'true']);
        $this->assertControlHasAttributes($response->getContent(), 'textarea', ['name' => 'friction_description', 'rows' => '5', 'required' => null, 'aria-required' => 'true']);
        $this->assertControlHasAttributes($response->getContent(), 'textarea', ['name' => 'current_process', 'rows' => '5', 'required' => null, 'aria-required' => 'true']);
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

    public function test_footer_links_garcia_systems_in_the_copyright_notice(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('&copy; '.date('Y').' <a class="hover:text-white hover:underline focus-visible:text-white focus-visible:underline" href="https://garciasystems.org">Garcia Systems</a>. All rights reserved.', false);

        $this->assertSame(1, substr_count($response->getContent(), 'href="https://garciasystems.org"'));
    }

    public function test_problems_page_presents_recognizable_friction_and_balanced_outcomes(): void
    {
        $response = $this->get('/problems');

        $response
            ->assertOk()
            ->assertSee('Where is the work getting harder than it needs to be?')
            ->assertSee('Customers have to ask for help with something routine.')
            ->assertSee('Scheduling becomes a conversation instead of a transaction.')
            ->assertSee('Customers enter information once. Staff enter it again.')
            ->assertSee("The tools work. They just don't work together.", false)
            ->assertSee("Customers don't know what happens next.", false)
            ->assertSeeInOrder(['Configure', 'Integrate', 'Automate', 'Custom Build', 'Leave Alone'])
            ->assertSee('A hypothetical membership workflow')
            ->assertSee('not a customer case study')
            ->assertSee('data-analytics-location="problems_hero"', false)
            ->assertSee('data-analytics-location="problems_audit_section"', false)
            ->assertSee('data-analytics-location="problems_final"', false)
            ->assertSee('href="'.route('digital-friction-audit').'"', false)
            ->assertDontSee('Log in')
            ->assertDontSee('Register');
    }

    public function test_about_page_explains_identity_principles_and_truthful_evidence(): void
    {
        $this->get('/about')->assertOk()
            ->assertSee('Better business systems start with better questions.')
            ->assertSee('Garcia Systems is the parent, legal, and professional company')
            ->assertSeeInOrder(['Configure', 'Integrate', 'Automate', 'Custom Build', 'Leave Alone'])
            ->assertSee('Proof should come from real work.')
            ->assertSee('data-analytics-location="about_hero"', false)
            ->assertSee('href="'.route('digital-friction-audit').'"', false)
            ->assertDontSee('Trusted by')->assertDontSee('Log in')->assertDontSee('Register');
    }

    public function test_contact_page_renders_minimal_accessible_general_inquiry_form(): void
    {
        $response = $this->get('/contact')->assertOk()
            ->assertSee('Start a conversation.')
            ->assertSee('Which path should I use?')
            ->assertSee('action="'.route('contact-requests.store').'" method="POST"', false)
            ->assertSee('data-analytics-form="general-contact"', false)
            ->assertSee('href="'.route('digital-friction-audit').'"', false);

        foreach (['name', 'email', 'phone', 'business_name', 'message'] as $field) {
            $response->assertSee('name="'.$field.'"', false);
        }

        $response->assertSee('autocomplete="name" required aria-required="true"', false)
            ->assertSee('type="email"', false)->assertSee('type="tel"', false)
            ->assertSee('name="message" rows="7" required aria-required="true"', false)
            ->assertSee('name="_token"', false)->assertSee('href="'.route('privacy').'"', false)
            ->assertDontSee('budget')->assertDontSee('Log in')->assertDontSee('Register');
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
            'problems' => ['/problems', 'Where is the work getting harder than it needs to be?'],
            'about' => ['/about', 'Better business systems start with better questions.'],
            'insights' => ['/insights', 'Practical notes on making business easier to use.'],
            'contact' => ['/contact', 'Start a conversation.'],
            'privacy' => ['/privacy', 'Privacy matters.'],
        ];
    }

    private function assertControlHasAttributes(string $html, string $element, array $attributes): void
    {
        $lookaheads = collect($attributes)->map(function (?string $value, string $attribute): string {
            $attribute = preg_quote($attribute, '/');

            return $value === null
                ? "(?=[^>]*\\s{$attribute}(?:\\s|=|>))"
                : "(?=[^>]*\\s{$attribute}=\"".preg_quote($value, '/').'\")';
        })->implode('');

        $this->assertMatchesRegularExpression("/<{$element}\\b{$lookaheads}[^>]*>/i", $html);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class AnalyticsTest extends TestCase
{
    public function test_analytics_script_is_not_rendered_when_disabled(): void
    {
        config(['analytics.enabled' => false, 'analytics.provider' => 'plausible', 'analytics.site_id' => 'local.test']);

        $this->get('/')
            ->assertOk()
            ->assertDontSee('analytics-provider', false)
            ->assertDontSee('https://plausible.io/js/script.js', false);
    }

    public function test_plausible_script_uses_configured_public_site_id_when_enabled(): void
    {
        config(['analytics.enabled' => true, 'analytics.provider' => 'plausible', 'analytics.site_id' => 'local.example']);

        $this->get('/')
            ->assertOk()
            ->assertSee('<meta name="analytics-provider" content="plausible">', false)
            ->assertSee('defer data-domain="local.example" src="https://plausible.io/js/script.js"', false);
    }

    public function test_incomplete_or_unsupported_configuration_does_not_load_a_script(): void
    {
        config(['analytics.enabled' => true, 'analytics.provider' => 'unsupported', 'analytics.site_id' => 'local.example']);
        $this->get('/')->assertDontSee('https://plausible.io/js/script.js', false);

        config(['analytics.provider' => 'plausible', 'analytics.site_id' => null]);
        $this->get('/')->assertDontSee('https://plausible.io/js/script.js', false);
    }

    public function test_representative_audit_calls_to_action_have_stable_hooks(): void
    {
        $this->get('/')
            ->assertSee('data-analytics-event="audit_cta_click" data-analytics-location="header"', false)
            ->assertSee('data-analytics-event="audit_cta_click" data-analytics-location="mobile_navigation"', false)
            ->assertSee('data-analytics-event="audit_cta_click" data-analytics-location="home_hero"', false)
            ->assertSee('data-analytics-event="audit_cta_click" data-analytics-location="home_final_cta"', false);

        $this->get('/insights/before-you-build-software-check-what-you-already-own')
            ->assertSee('data-analytics-event="audit_cta_click" data-analytics-location="insight_article"', false);
    }

    public function test_audit_page_and_form_expose_only_semantic_funnel_hooks(): void
    {
        $this->get('/digital-friction-audit')
            ->assertSee('data-analytics-page="audit"', false)
            ->assertSee('data-analytics-form="audit-request"', false)
            ->assertDontSee('data-analytics-value', false);
    }

    public function test_privacy_page_describes_forms_attribution_and_analytics(): void
    {
        $this->get('/privacy')
            ->assertOk()
            ->assertSee('Audit requests include contact and business details')
            ->assertSee('limited first-touch attribution')
            ->assertSee('Plausible Analytics')
            ->assertSee('Form answers, names, contact details, business details, record IDs, and query-string values are not sent')
            ->assertSee('does not add analytics cookies, session replay, fingerprinting, behavioral scoring, or visitor profiles');
    }
}

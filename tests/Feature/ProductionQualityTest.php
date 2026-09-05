<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ProductionQualityTest extends TestCase
{
    #[DataProvider('metadataPages')]
    public function test_indexable_pages_have_unique_metadata_and_canonical_urls(string $path, string $title): void
    {
        config(['app.url' => 'https://local.example']);

        $this->get($path)
            ->assertOk()
            ->assertSee("<title>{$title}</title>", false)
            ->assertSee('<meta name="description" content="', false)
            ->assertSee('rel="canonical" href="https://local.example'.$path.'"', false)
            ->assertSee('<meta property="og:url" content="https://local.example'.$path.'">', false)
            ->assertSee('<meta name="twitter:card" content="summary">', false);
    }

    public static function metadataPages(): array
    {
        return [
            ['/', 'Local Works by Garcia Systems | Make Your Business Easier to Use'],
            ['/how-it-works', 'How It Works | Local Works by Garcia Systems'],
            ['/digital-friction-audit', 'Digital Friction Audit | Local Works by Garcia Systems'],
            ['/problems', 'Problems We Investigate | Local Works by Garcia Systems'],
            ['/about', 'About Local Works | Local Works by Garcia Systems'],
            ['/insights', 'Insights | Local Works by Garcia Systems'],
            ['/contact', 'Contact Local Works | Local Works by Garcia Systems'],
            ['/privacy', 'Privacy | Local Works by Garcia Systems'],
        ];
    }

    public function test_sitemap_contains_only_indexable_routes_and_published_articles(): void
    {
        $this->get('/sitemap.xml')->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee(route('digital-friction-audit'))
            ->assertSee(route('insights.show', 'the-problem-with-automating-a-bad-workflow'))
            ->assertDontSee('/thank-you')
            ->assertDontSee('/contact/thank-you')
            ->assertDontSee('draft-private-publishing-check');
    }

    public function test_robots_allows_public_content_and_points_to_sitemap(): void
    {
        $this->get('/robots.txt')->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee("Allow: /\n", false)
            ->assertSee('Disallow: /up')
            ->assertSee(route('sitemap'));
    }

    public function test_public_responses_include_modest_security_headers(): void
    {
        $this->get('/')->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
    }

    public function test_not_found_response_is_branded_and_not_indexable(): void
    {
        $this->get('/not-a-public-route')->assertNotFound()
            ->assertSee('We couldn’t find that page.')
            ->assertSee('content="noindex, nofollow"', false)
            ->assertDontSee('Stack trace');
    }
}

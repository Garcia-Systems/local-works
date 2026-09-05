<?php

namespace Tests\Feature;

use App\Services\InsightContent;
use RuntimeException;
use Tests\TestCase;

class InsightsTest extends TestCase
{
    public function test_index_lists_published_articles_newest_first_and_excludes_drafts(): void
    {
        $this->get('/insights')->assertOk()
            ->assertSee('Practical notes on making business easier to use.')
            ->assertSeeInOrder(['When “Just Call Us” Is Worth Investigating', 'The Problem With Automating a Bad Workflow', 'Before You Build Software, Check What You Already Own'])
            ->assertDontSee('Draft: A Private Publishing Check')
            ->assertSee('data-analytics-view="insights-index"', false);
    }

    public function test_a_published_article_renders_safe_markdown_and_audit_cta(): void
    {
        $this->get('/insights/the-problem-with-automating-a-bad-workflow')->assertOk()
            ->assertSee('The Problem With Automating a Bad Workflow')
            ->assertSee('<h2>Understand the work first</h2>', false)
            ->assertSee('<ol>', false)
            ->assertSee('data-analytics-view="insight-article"', false)
            ->assertSee('data-analytics-action="insight-audit-cta"', false)
            ->assertSee('href="'.route('digital-friction-audit').'"', false);
    }

    public function test_missing_and_draft_slugs_return_not_found(): void
    {
        $this->get('/insights/not-a-real-insight')->assertNotFound();
        $this->get('/insights/draft-private-publishing-check')->assertNotFound();
    }

    public function test_loader_discovers_extracts_sorts_and_sanitizes_content(): void
    {
        $directory = $this->temporaryDirectory();
        $this->write($directory, 'older.md', $this->article('Older', 'older', '2026-01-01', '## Heading\n\n<script>alert(1)</script> **Useful** [unsafe](javascript:alert(1))'));
        $this->write($directory, 'newer.md', $this->article('Newer', 'newer', '2026-01-02', 'Body'));
        $this->write($directory, 'draft.md', $this->article('Draft', 'draft', '2026-01-03', 'Body', "draft: true\n"));

        $articles = (new InsightContent($directory))->published();

        $this->assertSame(['newer', 'older'], $articles->pluck('slug')->all());
        $this->assertSame('Insight', $articles->last()['type_label']);
        $this->assertStringContainsString('<h2>Heading</h2>', $articles->last()['html']);
        $this->assertStringContainsString('<strong>Useful</strong>', $articles->last()['html']);
        $this->assertStringNotContainsString('<script>', $articles->last()['html']);
        $this->assertStringNotContainsString('href="javascript:', $articles->last()['html']);
        $this->assertSame('newer', (new InsightContent($directory))->findPublished('newer')['slug']);
    }

    public function test_loader_fails_clearly_when_required_metadata_is_missing(): void
    {
        $directory = $this->temporaryDirectory();
        $this->write($directory, 'broken.md', "---\ntitle: Broken\n---\n\nBody");
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('missing required metadata');
        (new InsightContent($directory))->all();
    }

    private function article(string $title, string $slug, string $date, string $body, string $extra = ''): string
    {
        return "---\ntitle: \"{$title}\"\nslug: \"{$slug}\"\nsummary: \"A useful summary.\"\npublished_at: \"{$date}\"\ntype: \"insight\"\n{$extra}---\n\n{$body}";
    }

    private function temporaryDirectory(): string
    {
        $directory = storage_path('framework/testing/insights-'.bin2hex(random_bytes(5)));
        mkdir($directory, 0777, true);
        $this->beforeApplicationDestroyed(function () use ($directory): void {
            collect(glob($directory.'/*') ?: [])->each(fn ($file) => unlink($file));
            rmdir($directory);
        });
        return $directory;
    }

    private function write(string $directory, string $file, string $content): void
    {
        file_put_contents($directory.'/'.$file, $content);
    }
}

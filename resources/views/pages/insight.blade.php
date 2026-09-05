@extends('layouts.public')
@section('title', $article['title'].' | Local Works by Garcia Systems')
@section('meta_description', $article['summary'])
@section('og_type', 'article')
@push('structured-data')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org', '@type' => 'Article',
    'headline' => $article['title'], 'description' => $article['summary'],
    'datePublished' => $article['published_at']->toDateString(),
    'dateModified' => ($article['updated_at'] ?? $article['published_at'])->toDateString(),
    'mainEntityOfPage' => route('insights.show', $article['slug']),
    'publisher' => ['@id' => rtrim(config('app.url'), '/').'/#organization'],
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endpush
@section('og_type', 'article')
@section('content')
    <article data-analytics-view="insight-article">
        <header class="border-b border-warm-200 bg-warm-100">
            <div class="site-container py-12 sm:py-16 lg:py-20">
                <div class="mx-auto max-w-3xl">
                    <a class="content-link text-sm" href="{{ route('insights') }}">← Back to Insights</a>
                    <div class="insight-meta mt-8">
                        <span>{{ $article['type_label'] }}</span>
                        <time datetime="{{ $article['published_at']->toDateString() }}">Published {{ $article['published_at']->format('F j, Y') }}</time>
                        @if ($article['updated_at'])<time datetime="{{ $article['updated_at']->toDateString() }}">Updated {{ $article['updated_at']->format('F j, Y') }}</time>@endif
                    </div>
                    <h1 class="page-heading mt-5">{{ $article['title'] }}</h1>
                    <p class="body-large mt-6">{{ $article['summary'] }}</p>
                    @if ($article['tags'])<ul class="insight-tags mt-7" aria-label="Topics">@foreach ($article['tags'] as $tag)<li>{{ $tag }}</li>@endforeach</ul>@endif
                </div>
            </div>
        </header>

        <div class="site-container section-space">
            <div class="article-prose mx-auto">{!! $article['html'] !!}</div>
        </div>

        <aside class="border-t border-local-200 bg-local-50" aria-labelledby="article-cta-title">
            <div class="site-container py-14 sm:py-16"><div class="mx-auto max-w-3xl rounded-2xl border border-local-200 bg-white p-6 sm:p-9">
                <p class="eyebrow mb-3">A practical next step</p>
                <h2 id="article-cta-title" class="text-3xl">Have a workflow like this?</h2>
                <p class="body-copy mt-4">Describe how it works today. Local Works will start with the workflow, the evidence, and whether changing it is worthwhile—not with a predetermined technology.</p>
                <div class="mt-7 flex flex-col gap-3 sm:flex-row"><a class="button button-primary" href="{{ route('digital-friction-audit') }}" data-analytics-event="audit_cta_click" data-analytics-location="insight_article">Request a Digital Friction Audit</a><a class="button button-secondary" href="{{ route('how-it-works') }}">See How It Works</a></div>
            </div></div>
        </aside>
    </article>
@endsection

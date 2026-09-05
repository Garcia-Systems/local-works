@extends('layouts.public')
@section('title', 'Insights | Local Works')
@section('meta_description', 'Practical observations and lessons about customer workflows, staff processes, automation, integration and business technology decisions.')
@section('content')
    <div data-analytics-view="insights-index">
        <x-page-introduction eyebrow="Insights" title="Practical notes on making business easier to use.">
            Local Works publishes observations and lessons about customer workflows, staff processes, systems, and practical technology decisions. Each piece is labeled so the kind of evidence behind it stays clear.
        </x-page-introduction>

        <section class="border-t border-warm-200 bg-white" aria-labelledby="latest-insights">
            <div class="site-container section-space">
                <div class="reading-container">
                    <p class="eyebrow mb-4">From Local Works</p>
                    <h2 id="latest-insights" class="section-heading">Latest insights</h2>
                </div>
                <ol class="insight-list mt-10">
                    @foreach ($articles as $article)
                        <li>
                            <article>
                                <div class="insight-meta">
                                    <span>{{ $article['type_label'] }}</span>
                                    <time datetime="{{ $article['published_at']->toDateString() }}">{{ $article['published_at']->format('F j, Y') }}</time>
                                </div>
                                <div>
                                    <h3><a href="{{ route('insights.show', $article['slug']) }}">{{ $article['title'] }}</a></h3>
                                    <p>{{ $article['summary'] }}</p>
                                    @if ($article['tags'])
                                        <ul class="insight-tags" aria-label="Topics">
                                            @foreach ($article['tags'] as $tag)<li>{{ $tag }}</li>@endforeach
                                        </ul>
                                    @endif
                                </div>
                                <a class="insight-read-link" href="{{ route('insights.show', $article['slug']) }}" aria-label="Read {{ $article['title'] }}">Read insight <span aria-hidden="true">→</span></a>
                            </article>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>
    </div>
@endsection

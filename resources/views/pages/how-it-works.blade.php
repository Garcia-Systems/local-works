@extends('layouts.public')
@section('title', 'How It Works')
@section('meta_description', 'See how Local Works observes, understands, and measures workflow friction before choosing a practical response.')
@section('content')
    <x-page-introduction eyebrow="How it works" title="Start with the problem, not the software.">
        We look at the real workflow before recommending a change. The right answer may be a better setup, a careful connection, a small automation—or no change at all.
        <x-slot:actions><a class="button button-primary" href="{{ route('digital-friction-audit') }}">Request an Audit</a></x-slot:actions>
    </x-page-introduction>
    <section class="section-space bg-warm-50" aria-labelledby="process-title">
        <div class="site-container">
            <div class="reading-container mb-10"><p class="eyebrow mb-3">A grounded process</p><h2 id="process-title" class="section-heading">Understand before choosing.</h2><p class="body-copy mt-4">A shared visual pattern for the practical sequence that later page content will explain in detail.</p></div>
            <x-process-sequence :items="['Observe', 'Understand', 'Measure', 'Choose', 'Deliver']" label="Local Works delivery process" />
        </div>
    </section>
@endsection

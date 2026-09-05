@extends('layouts.public')

@section('title', 'Make your business easier to use')
@section('meta_description', 'Local Works helps businesses identify frustrating customer and employee workflows and choose the simplest practical improvement.')

@section('content')
    <section class="relative overflow-hidden bg-white" aria-labelledby="home-title">
        <div class="site-container section-space relative">
            <div class="pointer-events-none absolute -right-24 -top-32 size-96 rounded-full bg-local-50" aria-hidden="true"></div>
            <div class="relative max-w-4xl py-4 sm:py-8">
                <p class="eyebrow mb-5">Practical workflow improvement</p>
                <h1 id="home-title" class="display-heading max-w-3xl">Make your business easier to use.</h1>
                <p class="body-large mt-7 max-w-2xl">Local Works helps identify frustrating customer and employee workflows, then finds the simplest practical way to improve them.</p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a class="button button-primary" href="{{ route('digital-friction-audit') }}">Request a Digital Friction Audit</a>
                    <a class="button button-secondary" href="{{ route('how-it-works') }}">See How It Works</a>
                </div>
            </div>
        </div>
    </section>
    <section class="border-y border-warm-200 bg-warm-100 py-8" aria-label="Local Works approach">
        <div class="site-container"><p class="max-w-3xl text-lg font-medium leading-8">Start with the real problem. Use technology only when it makes the experience meaningfully simpler.</p></div>
    </section>
@endsection

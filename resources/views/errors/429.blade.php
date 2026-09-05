@extends('layouts.public')
@section('title', 'Too Many Requests | Local Works by Garcia Systems')
@section('meta_description', 'Too many requests were submitted in a short period. Please try again later.')
@section('robots', 'noindex, nofollow')
@section('content')
<section class="bg-white" aria-labelledby="error-title">
    <div class="site-container section-space"><div class="reading-container">
        <p class="eyebrow mb-4">Error 429</p>
        <h1 id="error-title" class="page-heading">Please wait before trying again.</h1>
        <p class="body-large mt-6">Too many requests were submitted in a short period. Please try again later.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a class="button button-primary" href="{{ route('home') }}">Return Home</a>
            <a class="button button-secondary" href="{{ route('digital-friction-audit') }}">Digital Friction Audit</a>
            <a class="content-link self-center" href="{{ route('how-it-works') }}">How It Works</a>
        </div>
    </div></div>
</section>
@endsection

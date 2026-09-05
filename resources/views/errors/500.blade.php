@extends('layouts.public')
@section('title', 'Something Went Wrong | Local Works by Garcia Systems')
@section('meta_description', 'The request could not be completed. Please try again later or return to the home page.')
@section('robots', 'noindex, nofollow')
@section('content')
<section class="bg-white" aria-labelledby="error-title">
    <div class="site-container section-space"><div class="reading-container">
        <p class="eyebrow mb-4">Error 500</p>
        <h1 id="error-title" class="page-heading">Something went wrong.</h1>
        <p class="body-large mt-6">The request could not be completed. Please try again later or return to the home page.</p>
        <div class="mt-8 flex flex-wrap gap-3">
            <a class="button button-primary" href="{{ route('home') }}">Return Home</a>
            <a class="button button-secondary" href="{{ route('digital-friction-audit') }}">Digital Friction Audit</a>
            <a class="content-link self-center" href="{{ route('how-it-works') }}">How It Works</a>
        </div>
    </div></div>
</section>
@endsection

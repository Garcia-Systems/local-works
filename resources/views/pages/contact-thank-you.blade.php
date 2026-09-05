@extends('layouts.public')

@section('title', 'Message Received | Local Works by Garcia Systems')
@section('meta_description', 'Confirmation that Local Works received a general contact message.')
@section('robots', 'noindex, nofollow')

@section('content')
    <section class="bg-white" aria-labelledby="contact-thank-you-title" data-submission-event="contact_form_submit" data-analytics-success-event="contact_form_submit">
        <div class="site-container section-space"><div class="reading-container"><p class="eyebrow mb-4">Message received</p><h1 id="contact-thank-you-title" class="page-heading">Your message has been received.</h1><p class="body-large mt-6">Local Works will review what you shared. This confirmation does not promise a specific response time or outcome.</p><div class="mt-8 flex flex-wrap gap-3"><a class="button button-primary" href="{{ route('home') }}">Return Home</a><a class="button button-secondary" href="{{ route('digital-friction-audit') }}">Explore the Digital Friction Audit</a></div></div></div>
    </section>
@endsection

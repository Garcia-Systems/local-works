@extends('layouts.public')
@section('title', 'Privacy | Local Works by Garcia Systems')
@section('meta_description', 'Learn what the Local Works website collects through audit and contact forms, first-touch attribution, and optional privacy-conscious analytics.')
@section('content')
    <x-page-introduction eyebrow="Supporting information" title="Privacy matters.">
        Local Works collects the information you choose to provide in a Digital Friction Audit request or general contact message so Garcia Systems can evaluate it and respond when a conversation makes sense.
    </x-page-introduction>

    <section class="section-space bg-white" aria-labelledby="privacy-details-title">
        <div class="site-container max-w-3xl">
            <h2 id="privacy-details-title" class="section-heading">What this website collects.</h2>
            <div class="body-copy mt-6 grid gap-5">
                <p>Audit requests include contact and business details, your description of the workflow, and any optional context you provide. General contact messages include your name, email, message, and any optional phone or organization details. The site also retains limited first-touch attribution: the original landing path, referring URL, and campaign parameters when present.</p>
                <p>Do not submit passwords, system credentials, payment information, government identification, or other highly sensitive information. Detailed system access is not needed to make an initial request.</p>
                <p>Request information is used to review and respond to the inquiry. Attribution is used to understand which outreach led to a real request. This information is not exposed in a public directory, and lead management remains outside the custom website.</p>
                <h3 class="text-xl">Limited website analytics</h3>
                <p>When analytics is enabled, Local Works uses Plausible Analytics to measure aggregate page visits and a small conversion funnel: audit links clicked, arrival at the audit page, the beginning of the audit form, and server-confirmed audit or contact submissions. Custom analytics events contain only a predefined event name and, for audit links, a predefined page location. Form answers, names, contact details, business details, record IDs, and query-string values are not sent in these events.</p>
                <p>This setup does not add analytics cookies, session replay, fingerprinting, behavioral scoring, or visitor profiles. Analytics can be blocked or unavailable without preventing navigation or form submission. Plausible is a third-party service and processes the limited website measurement data used for its reports.</p>
                <p>For a privacy question about this website, use the <a href="{{ route('contact') }}">general contact form</a> and do not include sensitive credentials.</p>
            </div>
        </div>
    </section>
@endsection

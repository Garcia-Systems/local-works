@extends('layouts.public')
@section('title', 'Privacy')
@section('meta_description', 'Privacy information for the Local Works by Garcia Systems website.')
@section('content')
    <x-page-introduction eyebrow="Supporting information" title="Privacy matters.">
        Local Works collects the information you choose to provide in a Digital Friction Audit request so Garcia Systems can evaluate it and respond when a conversation makes sense.
    </x-page-introduction>

    <section class="section-space bg-white" aria-labelledby="privacy-details-title">
        <div class="site-container max-w-3xl">
            <h2 id="privacy-details-title" class="section-heading">What the request process keeps.</h2>
            <div class="body-copy mt-6 grid gap-5">
                <p>Requests include contact and business details, your description of the workflow, and any optional context you provide. The site also retains limited first-touch attribution: the original landing path, referring URL, and campaign parameters when present.</p>
                <p>Do not submit passwords, system credentials, payment information, government identification, or other highly sensitive information. Detailed system access is not needed to make an initial request.</p>
                <p>Request information is used to review and respond to the inquiry. It is not exposed in a public directory, and the site does not collect device fingerprints for this process. Lead management remains outside the custom website.</p>
            </div>
        </div>
    </section>
@endsection

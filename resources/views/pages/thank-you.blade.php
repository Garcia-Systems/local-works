@extends('layouts.public')
@section('title', 'Request Received | Local Works')
@section('meta_description', 'Confirmation for a submitted Local Works Digital Friction Audit request.')
@section('content')
    <div data-submission-event="audit_form_submit" data-analytics-success-event="audit_form_submit">
    <x-page-introduction eyebrow="Request received" title="Your request has been received.">
        Local Works will review the information you provided. If a conversation makes sense, we will follow up. You do not need to diagnose the solution or provide detailed system access at this stage.
        <x-slot:actions><a class="button button-secondary" href="{{ route('home') }}">Return home</a></x-slot:actions>
    </x-page-introduction>
    </div>
@endsection

@extends('layouts.public')
@section('title', 'Digital Friction Audit')
@section('meta_description', 'Learn about the Local Works Digital Friction Audit, a practical first step toward identifying frustrating business workflows.')
@section('content')
    <x-page-introduction eyebrow="Digital Friction Audit" title="Find the friction worth fixing.">
        This page will explain the focused first step for discussing a frustrating customer or staff workflow. The request form is intentionally reserved for a later, privacy-conscious implementation.
        <x-slot:actions><a class="button button-secondary" href="{{ route('contact') }}">Contact Local Works</a></x-slot:actions>
    </x-page-introduction>
@endsection

@extends('layouts.public')
@section('title', 'Contact')
@section('meta_description', 'Contact Local Works by Garcia Systems to start a practical conversation about business workflow friction.')
@section('content')
    <x-page-introduction eyebrow="Contact" title="Start a conversation.">
        This page is prepared for verified contact details. Until those are supplied, the site does not publish fabricated channels or collect information through an unfinished form.
        <x-slot:actions><a class="button button-secondary" href="{{ route('digital-friction-audit') }}">Learn about the Audit</a></x-slot:actions>
    </x-page-introduction>
@endsection

@extends('layouts.public')
@section('title', 'Thank You')
@section('meta_description', 'Local Works confirmation page reserved for the future Digital Friction Audit request flow.')
@section('content')
    <x-page-introduction eyebrow="Confirmation" title="Thank you.">
        This polished shell is reserved for a truthful confirmation after the future Digital Friction Audit request flow is implemented. It does not imply that a request has been submitted.
        <x-slot:actions><a class="button button-secondary" href="{{ route('home') }}">Return home</a></x-slot:actions>
    </x-page-introduction>
@endsection

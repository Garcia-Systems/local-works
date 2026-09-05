@extends('layouts.public')
@section('title', 'Problems We Investigate')
@section('meta_description', 'Local Works investigates avoidable friction in customer and employee workflows.')
@section('content')
    <x-page-introduction eyebrow="Problems" title="Everyday work should not be this hard.">
        This page will help business owners recognize friction in scheduling, intake, payments, handoffs, repetitive administration, and disconnected tools—without assuming software is always the answer.
        <x-slot:actions><a class="button button-primary" href="{{ route('digital-friction-audit') }}">Request an Audit</a></x-slot:actions>
    </x-page-introduction>
@endsection

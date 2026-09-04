<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Local Works helps businesses identify frustrating workflows and find the simplest practical way to improve them.">
    <title>@yield('title', 'Local Works') | by Garcia Systems</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-charcoal antialiased">
    <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-white focus:p-3" href="#main-content">Skip to content</a>
    <header class="border-b border-stone-200">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5">
            <a href="{{ route('home') }}" aria-label="Local Works home">
                <span class="block font-bold tracking-widest text-local-green">LOCAL WORKS</span>
                <span class="block text-xs text-stone-600">by Garcia Systems</span>
            </a>
            <nav aria-label="Primary navigation">
                <ul class="flex flex-wrap gap-x-5 gap-y-2 text-sm">
                    <li><a href="{{ route('how-it-works') }}">How It Works</a></li>
                    <li><a href="{{ route('problems') }}">Problems</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('insights') }}">Insights</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a class="font-semibold text-local-green" href="{{ route('digital-friction-audit') }}">Request an Audit</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main id="main-content" class="mx-auto max-w-6xl px-6 py-16">
        @yield('content')
    </main>
    <footer class="border-t border-stone-200 bg-warm-surface">
        <div class="mx-auto flex max-w-6xl flex-wrap justify-between gap-4 px-6 py-8 text-sm text-stone-700">
            <p>LOCAL WORKS <span class="text-stone-500">by Garcia Systems</span></p>
            <a href="{{ route('privacy') }}">Privacy</a>
        </div>
    </footer>
</body>
</html>

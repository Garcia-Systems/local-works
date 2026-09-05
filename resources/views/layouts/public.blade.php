<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', 'Local Works helps businesses identify frustrating customer and employee workflows and find the simplest practical way to improve them.')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Local Works by Garcia Systems">
    <meta property="og:title" content="@yield('title', 'Local Works') | by Garcia Systems">
    <meta property="og:description" content="@yield('meta_description', 'Make your business easier to use with practical workflow improvements.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <title>@yield('title', 'Local Works') | by Garcia Systems</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:block focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:font-bold focus:text-local-800 focus:shadow-lg" href="#main-content">Skip to main content</a>

    <header class="sticky top-0 z-40 border-b border-warm-200 bg-warm-50/95 backdrop-blur-sm" data-site-header>
        <div class="site-container flex min-h-20 items-center justify-between gap-4">
            <x-brand />

            <nav class="hidden lg:block" aria-label="Primary navigation">
                <ul class="flex items-center gap-5 xl:gap-7">
                    @foreach ([
                        'how-it-works' => 'How It Works',
                        'digital-friction-audit' => 'Digital Friction Audit',
                        'problems' => 'Problems',
                        'about' => 'About',
                        'insights' => 'Insights',
                    ] as $routeName => $label)
                        <li><a class="nav-link" href="{{ route($routeName) }}" @if(request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }}</a></li>
                    @endforeach
                </ul>
            </nav>

            <a class="button button-primary hidden lg:inline-flex" href="{{ route('digital-friction-audit') }}">Request an Audit</a>
            <button class="flex min-h-11 min-w-11 items-center justify-center rounded-lg border border-warm-200 bg-white text-ink lg:hidden" type="button" aria-expanded="false" aria-controls="mobile-navigation" data-menu-toggle>
                <span class="sr-only" data-menu-label>Open menu</span>
                <svg class="size-6" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path data-menu-open d="M4 7h16M4 12h16M4 17h16"/><path class="hidden" data-menu-close d="M6 6l12 12M18 6L6 18"/></svg>
            </button>
        </div>

        <nav id="mobile-navigation" class="hidden border-t border-warm-200 bg-white lg:hidden" aria-label="Mobile navigation" data-mobile-menu>
            <div class="site-container py-4">
                <ul class="divide-y divide-warm-100">
                    @foreach ([
                        'how-it-works' => 'How It Works',
                        'digital-friction-audit' => 'Digital Friction Audit',
                        'problems' => 'Problems',
                        'about' => 'About',
                        'insights' => 'Insights',
                    ] as $routeName => $label)
                        <li><a class="flex min-h-12 items-center py-2 font-semibold text-ink" href="{{ route($routeName) }}" @if(request()->routeIs($routeName)) aria-current="page" @endif>{{ $label }} @if(request()->routeIs($routeName))<span class="ml-auto text-xs font-bold uppercase tracking-wider text-local-700">Current</span>@endif</a></li>
                    @endforeach
                </ul>
                <a class="button button-primary mt-4 w-full" href="{{ route('digital-friction-audit') }}">Request an Audit</a>
            </div>
        </nav>
    </header>

    <main id="main-content">@yield('content')</main>

    <footer class="border-t border-local-800 bg-ink text-white">
        <div class="site-container grid gap-12 py-12 sm:py-16 lg:grid-cols-[1.5fr_1fr_1fr]">
            <div class="max-w-md">
                <x-brand dark />
                <p class="mt-5 leading-7 text-stone-300">Helping businesses find and remove unnecessary friction from customer and staff workflows.</p>
            </div>
            <nav aria-label="Footer navigation">
                <h2 class="text-sm font-bold uppercase tracking-widest text-local-200">Explore</h2>
                <ul class="mt-4 grid grid-cols-2 gap-x-4 gap-y-3 text-sm text-stone-200 sm:grid-cols-1">
                    <li><a class="hover:text-white hover:underline" href="{{ route('how-it-works') }}">How It Works</a></li>
                    <li><a class="hover:text-white hover:underline" href="{{ route('digital-friction-audit') }}">Digital Friction Audit</a></li>
                    <li><a class="hover:text-white hover:underline" href="{{ route('problems') }}">Problems</a></li>
                    <li><a class="hover:text-white hover:underline" href="{{ route('about') }}">About</a></li>
                    <li><a class="hover:text-white hover:underline" href="{{ route('insights') }}">Insights</a></li>
                    <li><a class="hover:text-white hover:underline" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
            <div>
                <h2 class="text-sm font-bold uppercase tracking-widest text-local-200">Supporting</h2>
                <a class="mt-4 inline-block text-sm text-stone-200 hover:text-white hover:underline" href="{{ route('privacy') }}">Privacy</a>
            </div>
        </div>
        <div class="border-t border-white/10"><div class="site-container py-6 text-sm text-stone-400">&copy; {{ date('Y') }} Garcia Systems. All rights reserved.</div></div>
    </footer>
</body>
</html>

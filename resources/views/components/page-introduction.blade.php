@props(['eyebrow' => null, 'title'])

<section class="max-w-3xl" aria-labelledby="page-title">
    @if ($eyebrow)
        <p class="mb-3 text-sm font-semibold uppercase tracking-widest text-local-green">{{ $eyebrow }}</p>
    @endif
    <h1 id="page-title" class="text-4xl font-bold tracking-tight sm:text-5xl">{{ $title }}</h1>
    <div class="mt-6 text-lg leading-8 text-stone-700">{{ $slot }}</div>
</section>

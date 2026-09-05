@props(['eyebrow' => null, 'title'])

<section class="border-b border-warm-200 bg-white" aria-labelledby="page-title">
    <div class="site-container section-space">
        <div class="reading-container">
            @if ($eyebrow)<p class="eyebrow mb-4">{{ $eyebrow }}</p>@endif
            <h1 id="page-title" class="page-heading">{{ $title }}</h1>
            <div class="body-large mt-6 max-w-2xl">{{ $slot }}</div>
            @isset($actions)<div class="mt-8 flex flex-wrap gap-3">{{ $actions }}</div>@endisset
        </div>
    </div>
</section>

@props(['items', 'label' => 'Process'])

<ol class="grid gap-3 md:grid-cols-5" aria-label="{{ $label }}">
    @foreach ($items as $item)
        <li class="relative flex min-h-24 items-center gap-4 rounded-xl border border-warm-200 bg-white p-4 md:block md:min-h-32">
            <span class="grid size-8 shrink-0 place-items-center rounded-full bg-local-100 text-sm font-bold text-local-800" aria-hidden="true">{{ $loop->iteration }}</span>
            <span class="font-semibold leading-snug md:mt-4 md:block">{{ $item }}</span>
            @unless ($loop->last)<span class="absolute -bottom-4 left-7 z-10 text-local-500 md:-right-3 md:bottom-auto md:left-auto md:top-5" aria-hidden="true"><span class="md:hidden">↓</span><span class="hidden md:inline">→</span></span>@endunless
        </li>
    @endforeach
</ol>

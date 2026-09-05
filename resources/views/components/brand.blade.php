@props(['dark' => false])

<a {{ $attributes->class(['inline-flex items-center gap-3 rounded-sm', 'text-white' => $dark, 'text-ink' => ! $dark]) }} href="{{ route('home') }}" aria-label="Local Works home">
    <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-local-600 text-white" aria-hidden="true">
        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 18V9l8-5 8 5v9"/><path d="M8 18v-5h8v5M3 20h18"/></svg>
    </span>
    <span>
        <span class="block text-[0.95rem] font-extrabold leading-none tracking-[0.16em]">LOCAL WORKS</span>
        <span @class(['mt-1 block text-[0.7rem] leading-none', 'text-stone-400' => $dark, 'text-muted' => ! $dark])>by Garcia Systems</span>
    </span>
</a>

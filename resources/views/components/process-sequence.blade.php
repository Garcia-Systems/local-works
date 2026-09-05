@props(['items', 'label' => 'Process'])

<ol {{ $attributes->class(['process-sequence']) }} aria-label="{{ $label }}">
    @foreach ($items as $item)
        <li>
            <span aria-hidden="true">{{ $loop->iteration }}</span>
            <span>{{ $item }}</span>
            @unless ($loop->last)<span class="process-sequence__arrow" aria-hidden="true">↓</span>@endunless
        </li>
    @endforeach
</ol>

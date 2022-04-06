@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-red-400 text-sm text-red-500 font-bold hover:bg-red-200 text-right transition duration-150 ease-in-out'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent hover:border-red-400 text-sm text-red-500 font-bold hover:bg-red-200 text-right transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
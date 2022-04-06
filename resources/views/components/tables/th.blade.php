@props([
    'sortable' => null,
    'field' => null,
    'sortField' => null,
    'sortDirection' => null,
])

@php
    $direction = $sortField === $field ? $sortDirection : null;
@endphp

<th {{ $attributes->merge(['class' => 'px-3 py-2']) }}>
    @unless ( $sortable )
        <span class="uppercase font-bold whitespace-pre">{{ $slot }}</span>
    @else
        <button type="button" class="uppercase font-bold dark:hover:text-gray-400 hover:text-gray-600">
            <div class="flex items-center space-x-1">
                <span class="flex-none">{{ $slot }}</span>
                <span>
                    @if ( $direction === 'asc')
                        <x-heroicon-o-arrow-narrow-down class="h-3 w-3" />
                    @elseif ( $direction === 'desc')
                        <x-heroicon-o-arrow-narrow-up class="h-3 w-3" />
                    @else
                        <x-heroicon-o-switch-vertical class="h-3 w-3 opacity-25 group-hover:opacity-100 transition-opacity duration-300" />
                    @endif
                </span>
            </div>
        </button>
    @endunless
</th>
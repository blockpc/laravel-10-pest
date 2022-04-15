@props(['active'])

@php
$classes = ($active ?? false)
            ? 'my-1 block py-2 px-4 transition text-sm duration-200 hover:bg-gray-200 dark:hover:bg-gray-600 border-l-2 border-blue-400 dark:border-blue-200 bg-gray-300 dark:bg-gray-900'
            : 'my-1 block py-2 px-4 transition text-sm duration-200 hover:bg-gray-200 dark:hover:bg-gray-600';
@endphp

<div class="relative" x-data="{ open: false }" x-on:click.away="open = false" x-on:close.stop="open = false">
    <div class="flex justify-between items-center {{$classes}}" x-on:click="open = ! open">
        {{ $trigger }}
        <div :class="open ? 'transform rotate-180' : 'transform rotate-0'">
            <x-bx-chevron-up class="fill-current h-4 w-4" />
        </div>
    </div>

    <div x-show="open"
        x-on:click="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-20 w-64 shadow-lg origin-top-left left-0"
        style="display: none;">
        <div class="rounded-md rounded-t-none border-b-2 border-gray-600 border-l border-r py-1 nav-dark text-sm">
            <div class="flex flex-col">
            {{ $content }}
            </div>
        </div>
    </div>
</div>

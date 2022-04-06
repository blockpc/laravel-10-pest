@props(['align' => 'right', 'width' => '48'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'origin-top-left left-0';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
    default:
        $alignmentClasses = 'origin-top-right right-0';
        break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
    case '64':
        $width = 'w-64';
        break;
}
@endphp

<div class="relative" x-data="{ open: false }" x-on:click.outside="open = false" @close.stop="open = false">
    <div class="flex justify-between items-center space-x-2" x-on:click="open = ! open">
        {{ $trigger }}
        <div :class="open ? 'transform rotate-180' : 'transform rotate-0'">
            <x-bx-chevron-up class="fill-current h-4 w-4" />
        </div>
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-20 mt-2 {{ $width }} rounded-md shadow-lg {{ $alignmentClasses }}"
            style="display: none;"
            x-on:click="open = false">
        <div class="p-1 nav-dark">
            {{ $content }}
        </div>
    </div>
</div>

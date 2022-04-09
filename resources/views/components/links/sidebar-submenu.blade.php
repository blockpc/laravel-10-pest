<a {{$attributes->merge(['class' => 'flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600']) }}>
    <x-bx-chevron-right class="w-5 h-5" />
    <span>{{ $slot }}</span>
</a>
<a {{$attributes->merge(['class' => 'flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-600']) }}>
    <x-bx-circle class="ml-3 w-3 h-5" />
    <span>{{ $slot }}</span>
</a>
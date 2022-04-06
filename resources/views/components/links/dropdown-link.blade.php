<a {{ $attributes->merge(['class' => 'text-xs rounded-r-md flex items-center space-x-2 whitespace-nowrap px-4 py-2.5 w-full hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200']) }}>
    <span class="">
        {{ $slot }}
    </span>
</a>
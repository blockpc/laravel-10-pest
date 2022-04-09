@props(['active', 'permission' => 'user list'])

@php
$classes = ($active ?? false)
            ? 'my-1 block py-2 px-4 transition text-sm duration-200 hover:bg-gray-200 dark:hover:bg-gray-600 border-l-2 border-blue-400 dark:border-blue-200 bg-gray-300 dark:bg-gray-900'
            : 'my-1 block py-2 px-4 transition text-sm duration-200 hover:bg-gray-200 dark:hover:bg-gray-600';
@endphp

@if ( current_user()->can($permission) )
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
@endif
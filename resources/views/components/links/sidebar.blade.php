@props(['name' => 'Link', 'route' => '#'])
<div {{ $attributes->merge(['class' => 'relative group hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200 text-sm']) }}>
    <a class="flex items-center py-2" href="{{$route}}">
        <div class="w-16">
            {{ $icon }}
        </div>
        <div class="w-48 hidden lg:block">
            {{$name}}
        </div>
    </a>
    <div class="px-4 py-2.5 w-48 items-center space-x-2 rounded-r-md 
        bg-gray-200 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-600
        border border-l-0 border-white dark:border-gray-800 
        transition-all duration-200 
        hidden group-hover:block group-hover:lg:hidden
        group-hover:absolute group-hover:left-full group-hover:top-0 group-hover:-mt-[1px]">
        <div class="flex items-center space-x-2">
            <a href="{{$route}}" class="whitespace-nowrap">{{$name}}</a>
        </div>
    </div>
</div>
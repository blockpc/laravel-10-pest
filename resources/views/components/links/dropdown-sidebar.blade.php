@props(['name' => 'Link', 'icon' => 'bx-link'])

<div {{ $attributes->merge(['class' => 'relative group hover:bg-gray-100 dark:hover:bg-gray-600 transition-all duration-200 text-sm']) }}>
    <div class="dropdown-links flex items-center py-2 cursor-default">
        <div class="flex items-center">
            <span class="w-16">
                {{ $icon }}
            </span>
            <div class="w-48 hidden lg:block">
                <div class="flex items-center">
                    <span class="w-40">{{$name}}</span>
                    <div class="w-8 transform rotate-0 group-hover:transform group-hover:rotate-180">
                        <x-bx-chevron-left class="fill-current h-4 w-4 mx-auto" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-48 rounded-r-md 
    bg-gray-200 dark:bg-gray-800 
    border border-l-0 border-white dark:border-gray-800
    hidden group-hover:block
    group-hover:absolute group-hover:left-full group-hover:top-0 group-hover:-mt-[1px]">
        {{ $content }}
    </div>
</div>
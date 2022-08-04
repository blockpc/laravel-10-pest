@props(['route' => '#', 'active' => false, 'submenus' => [], 'first' => false, 'last' => false])

<div class="{{ $submenus ? 'group inline-block relative w-full' : '' }}">
    <a href="{{ $route }}" class="relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b border-gray-200 {{ $first ? 'rounded-t-lg' : ''}} {{ $last ? 'rounded-b-lg' : ''}} hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:text-white {{ $active ? 'dark:bg-gray-800 bg-gray-200 dark:hover:bg-gray-600 dark:hover:text-white' : 'dark:bg-gray-700 bg-white dark:hover:bg-gray-600 dark:hover:text-white'}}">

        <div class="flex items-center justify-between w-full">
            <div class="flex items-center">
                {{ $slot }}
            </div>
            @if ( $submenus )
                <div class="group-hover:rotate-180">
                    @svg('bx-caret-down', 'w-4 h-4')
                </div>
            @endif
        </div>

    </a>
    @if ( $submenus )
    <ul class="group-hover:block absolute hidden z-10 w-full text-gray-900 bg-white border border-gray-200 rounded-b-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @foreach ($submenus as $key => $submenu)
            <li class="">
                <a class="{{ $loop->last ? 'rounded-b-lg' : '' }} bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap text-sm" href="{{ $submenu }}">{{$key}}</a>
            </li>
        @endforeach
    </ul>
    @endif
</div>
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-300 text-gray-400 dark:border-gray-600 dark:text-gray-600 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a wire:click="previousPage" class="relative inline-flex items-center px-4 py-2 text-sm font-medium dark:text-gray-300 border dark:border-gray-300 border-gray-600 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a wire:click="nextPage" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium dark:text-gray-300 border dark:border-gray-300 border-gray-600 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium border border-gray-300 text-gray-400 dark:border-gray-600 dark:text-gray-600 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-gray-200 leading-5 flex space-x-1">
                    <span>Mostrando del</span>
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    <span>al</span>
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    <span>de</span>
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    <span>registros</span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    {{-- Previous Page Link --}}
                    @if (!$paginator->onFirstPage())
                        <a wire:click="previousPage" rel="prev" class="relative first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight border border-solid border-blue-600 bg-white text-blue-600 hover:bg-blue-100" aria-label="{{ __('pagination.previous') }}">
                            <x-heroicon-s-chevron-left class="w-4 h-4" />
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                {{-- Use three dots when current page is greater than 3. --}}
                                @if ($paginator->currentPage() > 3 && $page === 2)
                                    <div class="text-gray-800 dark:text-gray-200 flex items-center mx-1">
                                        <x-heroicon-o-dots-horizontal class="w-3 h-3" />
                                    </div>
                                @endif

                                {{-- Show active page two pages before and after it. --}}
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-blue-500 text-white bg-blue-500 cursor-pointer">{{ $page }}</span>
                                    </span>
                                @elseif ( $page === $paginator->currentPage() + 1 ||
                                    $page === $paginator->currentPage() + 2 || 
                                    $page === $paginator->currentPage() - 1 || 
                                    $page === $paginator->currentPage() - 2
                                )
                                    <a wire:click="gotoPage({{$page}})" class="relative first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight border border-solid border-blue-600 bg-white text-blue-600 hover:bg-blue-100 cursor-pointer" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif

                                {{-- Use three dots when current page is away from end. --}}
                                @if ($paginator->currentPage() < $paginator->lastPage() - 2  && $page === $paginator->lastPage() - 1)
                                    <div class="text-gray-800 dark:text-gray-200 flex items-center mx-1">
                                        <x-heroicon-o-dots-horizontal class="w-3 h-3" />
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a wire:click="nextPage" rel="next" class="relative first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight border border-solid border-blue-600 bg-white text-blue-600 hover:bg-blue-100" aria-label="{{ __('pagination.next') }}">
                            <x-heroicon-s-chevron-right class="w-4 h-4" />
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

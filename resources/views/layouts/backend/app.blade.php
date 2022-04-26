<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

        <title>@yield('title') | {{config('app.name', 'BlockPC')}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            [x-cloak] { 
                display: none !important;
            }
        </style>

        @livewireStyles
        @toastr_css
        @stack('styles')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-roboto text-dark bg-dark antialiased overflow-hidden">
        <div class="relative min-h-screen md:flex flex-col" 
            x-data="{sidebar:false, mode: localStorage.theme == 'dark'}">
            {{-- menu --}}
            @include('layouts.backend.navbar')
            {{-- sidebar --}}
            @include('layouts.backend.sidebar')
        </div>
        <div class="absolute top-0 pt-16 w-full overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 h-screen">
            <div class="content">
                <div class="flex flex-col space-y-2 h-sidebar w-full">
                    <main class="flex-1 p-2 md:p-4">
                        <x-alert-wire />
                        @yield('content')
                    </main>
                    <footer class="h-16 p-2 sm:p-4">
                        <div class="flex justify-between items-center">
                            <span>{{config('app.name', 'BlockPC') }}</span>
                            <a href="//blockpc.cl" target="_blank" class="text-xs font-semibold hover:text-gray-500 dark:hover:text-gray-400">Desarrollado por BlockPC @ {{ date('Y')}}</a>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        
        @livewireScripts
        @jquery
        @toastr_js
        @toastr_render
        @stack('scripts')
    </body>
</html>
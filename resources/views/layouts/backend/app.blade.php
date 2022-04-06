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
    <body class="font-roboto text-dark bg-dark antialiased overflow-hidden" x-data="{mode: localStorage.theme == 'dark'}">
        <div class="m-0 md:m-2 border-2 border-gray-300 dark:border-gray-800 rounded-md flex overflow-hidden">
            <div class="h-full nav-dark w-16 lg:w-64">
                <div class="logo-details flex items-center space-x-2 h-12">
                    <span class="w-16">
                        <x-application-logo class="h-8 w-8 mx-auto" />
                    </span>
                    <span class="logo-name text-2xl font-bold w-48 hidden lg:block">{{ config('app.name') }}</span>
                </div>
                <div>@include('layouts.backend.sidebar')</div>
            </div>
            <div class="relative flex flex-col w-full">
                <div>@include('layouts.backend.menu')</div>
                <div class="h-sidebar-sm lg:h-sidebar p-2 md:p-4 bg-dark overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400">
                    @yield('content')
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
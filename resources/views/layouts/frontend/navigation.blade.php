<nav x-data="{ open: false }" class="nav-dark">
    {{-- Primary Navigation Menu --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo --}}
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-dark" />
                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Settings Dropdown --}}
            <div class="flex space-x-4">
                <div class="px-2 h-16 flex">
                    <button type="button" x-on:click="mode=false" x-show="mode" class="setMode" id="sun">
                        <x-bx-sun class="h-5 w-5 text-yellow-300" />
                    </button>
                    <button type="button" x-on:click="mode=true" x-show="!mode" class="setMode" id="dark">
                        <x-bx-moon class="h-6 w-6 text-gray-800" />
                    </button>
                </div>

                {{-- Hamburger --}}
                <div class="-mr-2 flex items-center sm:hidden">
                    <button x-on:click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md focus:bg-gray-200 dark:focus:bg-gray-700 transition duration-150 ease-in-out">
                        <div :class="open ? 'hidden' : 'inline-flex'">
                            <x-bx-menu class="h-6 w-6" />
                        </div>
                        <div :class="! open ? 'hidden' : 'inline-flex' ">
                            <x-bx-x class="h-6 w-6" />
                        </div>
                    </button>
                </div>

                {{-- User/login options --}}
                <div class="hidden sm:flex sm:items-center">
                    @if ( current_user() )
                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-sm font-medium text-dark hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>
                                    <img class="rounded-full w-8 h-8 text-gray-600" src="{{ image_profile() }}" alt="{{ current_user()->name }}">
                                </div>
                                <div :class="open ? 'transform rotate-180' : 'transform rotate-0'">
                                    <x-bx-chevron-up class="fill-current h-4 w-4" />
                                </div>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                            <div class="flex items-center space-x-4 border-b-2 border-gray-200 dark:border-gray-600 pb-2">
                                <div class="pl-2">
                                    <img class="rounded-full w-8 h-8 text-gray-600" src="{{ image_profile() }}" alt="{{ current_user()->name }}">
                                </div>
                                <div class="">
                                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ current_user()->name }}</div>
                                    <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ current_user()->email }}</div>
                                </div>
                            </div>
                            <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')">
                                <div class="flex justify-between items-center">
                                    <span>{{ __('Profile User') }}</span>
                                    <x-bx-user-pin class="w-5 h-5" />
                                </div>
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                <div class="flex justify-between items-center">
                                    <span>{{ __('Dashboard') }}</span>
                                    <x-bx-layout class="w-5 h-5" />
                                </div>
                            </x-responsive-nav-link>
                            <hr class="border border-gray-600 w-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-logout-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-logout-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    @else
                    <div class="space-x-8 flex h-16">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Log In') }}
                        </x-nav-link>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Responsive Navigation Menu --}}
    <div :class="open ? 'block' : 'hidden'" class="">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        {{-- Responsive Settings Options --}}
        <div class="pt-4 pb-1 border-t border-b border-gray-500">
            @if ( current_user() )
            <div class="px-4 flex items-center space-x-4 border-b-2 border-gray-600 pb-2">
                <div class="">
                    <img class="rounded-full w-8 h-8 text-gray-600" src="{{ image_profile() }}" alt="{{ current_user()->name }}">
                </div>
                <div class="">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ current_user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ current_user()->email }}</div>
                </div>
            </div>
            <div class="space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-logout-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-logout-link>
                </form>
            </div>
            @else
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Log In') }}
            </x-responsive-nav-link>
            @endif
        </div>
    </div>
</nav>

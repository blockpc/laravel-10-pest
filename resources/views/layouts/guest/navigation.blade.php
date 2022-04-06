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
                </div>
            </div>
        </div>
    </div>

    {{-- Responsive Navigation Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        {{-- Responsive Settings Options --}}
        <div class="pt-4 pb-1 border-t border-b border-gray-500">
            
        </div>
    </div>
</nav>

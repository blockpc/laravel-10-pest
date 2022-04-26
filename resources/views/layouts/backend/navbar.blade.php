<div class="w-full bg-white dark:bg-gray-800 text-dark flex justify-between h-16 z-10 fixed">
    {{-- logo --}}
    <div class="w-auto md:w-64 flex items-center space-x-4 px-2 sm:px-4">
        <div class="w-16">
            <x-application-logo class="h-12 w-12 mx-auto" />
        </div>
        <div class="w-48 hidden md:block">
            <span class="text-lg font-bold">{{ config('app.name', 'BlockPC') }}</span>
        </div>
    </div>
    <div class="flex-1">
        {{-- mobile menu button --}}
        <button class="h-16 mobile-menu-button p-4" x-on:click="sidebar = !sidebar">
            <div :class="sidebar ? 'hidden' : 'inline-flex'">
                <x-bx-menu class="h-6 w-6" />
            </div>
            <div :class="! sidebar ? 'hidden' : 'inline-flex' ">
                <x-bx-x class="h-6 w-6" />
            </div>
        </button>
    </div>
    <div class="flex items-center space-x-2 shadow mx-4">
        {{-- Notifications --}}
        <button class="relative p-2 focus:bg-gray-100 dark:focus:bg-gray-600 focus:text-gray-600 dark:focus:text-gray-200 rounded-full">
            <span class="sr-only">{{__('common.notifications')}}</span>
            <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full"></span>
            <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full animate-ping"></span>
            <x-bx-bell class="h-6 w-6" />
        </button>
        {{-- dark mode button --}}
        <div class="h-16 flex">
            <button type="button" x-on:click="mode=false" x-show="mode" class="setMode" id="sun">
                <x-bx-sun class="h-5 w-5 text-yellow-300" />
            </button>
            <button type="button" x-on:click="mode=true" x-show="!mode" class="setMode" id="dark">
                <x-bx-moon class="h-6 w-6 text-gray-800" />
            </button>
        </div>
        {{-- Responsive User Options --}}
        <x-dropdown align="right" width="64">
            <x-slot name="trigger">
                <button class="flex items-center space-x-2 text-sm font-medium text-dark transition duration-150 ease-in-out mx-2">
                    <img class="rounded-full w-8 h-8 bg-inherit" src="{{ image_profile() }}" alt="{{ current_user()->profile->fullname }}">
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="flex items-center space-x-2 border-b-2 border-gray-200 dark:border-gray-600 p-2">
                    <div class="w-16">
                        <img class="rounded-full bg-inherit" src="{{ image_profile() }}" alt="{{ current_user()->profile->fullname }}">
                    </div>
                    <div>
                        <div class="font-bold text-base text-gray-800 dark:text-gray-200">{{ current_user()->profile->fullname }}</div>
                        <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ current_user()->cargo }}</div>
                    </div>
                </div>
                <x-links.sidebar-link :href="route('profile')" :active="request()->routeIs('profile')">
                    <div class="flex justify-between items-center">
                        <span>{{ __('common.profile-user') }}</span>
                        <x-bx-user-pin class="w-5 h-5" />
                    </div>
                </x-links.sidebar-link>
                <hr class="border border-gray-200 dark:border-gray-600">
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
    </div>
</div>
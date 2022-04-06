<div class="h-12 flex justify-between items-center nav-dark px-2 py-1">
    <div class="flex items-center"></div>
    <div class="flex items-center space-x-2">
        <button type="button" x-on:click="mode=false" x-show="mode" class="setMode" id="sun">
            <x-bx-sun class="h-5 w-5 text-yellow-300" />
        </button>
        <button type="button" x-on:click="mode=true" x-show="!mode" class="setMode" id="dark">
            <x-bx-moon class="h-6 w-6 text-gray-800" />
        </button>
        <x-dropdown align="right" width="64">
            <x-slot name="trigger">
                <button class="flex items-center space-x-2 text-sm font-medium text-dark transition duration-150 ease-in-out mx-2">
                    <img class="rounded-full w-8 h-8 text-gray-600" src="{{ image_profile() }}" alt="{{ current_user()->profile->fullname }}">
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="flex items-center space-x-2 border-b-2 border-gray-200 dark:border-gray-600 p-2">
                    <div class="w-12">
                        <img class="w-12 h-12 mx-auto rounded-full text-gray-600" src="{{ image_profile() }}" alt="{{ current_user()->profile->fullname }}">
                    </div>
                    <div>
                        <div class="font-bold text-base text-gray-800 dark:text-gray-200">{{ current_user()->profile->fullname }}</div>
                        <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ current_user()->cargo }}</div>
                    </div>
                </div>
                <x-sidebar-link :href="route('profile')" :active="request()->routeIs('profile')">
                    <div class="flex justify-between items-center">
                        <span>{{ __('Profile User') }}</span>
                        <x-bx-user-pin class="w-5 h-5" />
                    </div>
                </x-sidebar-link>
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
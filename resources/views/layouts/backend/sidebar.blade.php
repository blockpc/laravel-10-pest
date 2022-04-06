<div class="nav-links h-sidebar-sm lg:h-sidebar flex flex-col justify-between">
    <div class="flex flex-col justify-between h-sidebar-sm lg:h-sidebar">
        <div class="flex-1 flex-col space-y-2 my-2 z-10">
            {{--overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400--}}
            <x-links.sidebar name="{{__('pages.dashboard.titles.link')}}" route="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                <x-slot name="icon">
                    <x-bx-layout class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.hr />
            <x-links.sidebar name="{{__('pages.users.titles.link')}}" route="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                <x-slot name="icon">
                    <x-heroicon-s-user-group class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
        </div>
        <form class="relative hover:bg-red-100 hover:text-red-800 transition-all duration-200 my-2" method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="flex items-center py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="w-16">
                    <x-bx-log-out class="h-5 w-5 mx-auto text-red-500" />
                </span>
                <span class="link-name w-48 hidden lg:block">{{__('pages.logout')}}</span>
            </a>
        </form>
    </div>
</div>
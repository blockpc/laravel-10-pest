<div class="bg-white dark:bg-gray-800 w-64 fixed h-sidebar left-0 top-16 transform transition-all duration-500 ease-in-out z-50 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 py-2 shadow font-roboto font-semibold" :class="sidebar ? 'translate-x-0' : '-translate-x-full'" x-on:click.away="sidebar=false" x-show="sidebar" x-cloak
x-transition:enter="translate-x-0 ease-out duration-200"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="translate-x-0 ease-in duration-200"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0">
    {{-- menu sidebar --}}
    <x-links.sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-5 h-5" />
            <span>{{__('pages.dashboard.titles.link')}}</span>
        </div>
    </x-links.sidebar-link>
    <x-links.hr />
    <x-links.sidebar-dropdown :active="request()->routeIs('menus.*')">
        <x-slot name="trigger">
            <div class="flex space-x-2 items-center">
                <x-bx-code class="w-5 h-5" />
                <span>{{__('Mas Menus')}}</span>
            </div>
        </x-slot>
        <x-slot name="content">
            <x-links.sidebar-submenu href="#">
                {{__('Menu Uno')}}
            </x-links.sidebar-submenu>
            <x-links.sidebar-submenu href="#">
                {{__('Menu Dos')}}
            </x-links.sidebar-submenu>
            <x-links.sidebar-submenu href="#">
                {{__('Menu Tres')}}
            </x-links.sidebar-submenu>
        </x-slot>
    </x-links.sidebar-dropdown>
    <x-links.hr />
    {{-- User List --}}
    <x-links.sidebar-link :href="route('users.index')" :active="request()->routeIs('users.*')" permission="user list">
        <div class="flex space-x-2 items-center">
            <x-heroicon-s-users class="w-5 h-5" />
            <span>{{__('users.titles.link')}}</span>
        </div>
    </x-links.sidebar-link>
    {{-- Role List --}}
    <x-links.sidebar-link :href="route('roles.index')" :active="request()->routeIs('roles.*')" permission="role list">
        <div class="flex space-x-2 items-center">
            <x-bx-shield class="w-5 h-5" />
            <span>{{__('roles.titles.link')}}</span>
        </div>
    </x-links.sidebar-link>
    {{-- Permission List --}}
    <x-links.sidebar-link :href="route('permissions.index')" :active="request()->routeIs('permissions.*')" permission="permission list">
        <div class="flex space-x-2 items-center">
            <x-bx-label class="w-5 h-5" />
            <span>{{__('permissions.titles.link')}}</span>
        </div>
    </x-links.sidebar-link>
</div>
<div class="nav-links h-sidebar-sm lg:h-sidebar flex flex-col justify-between">
    <div class="flex flex-col justify-between h-sidebar-sm lg:h-sidebar">
        <div class="flex-1 flex-col space-y-2 my-2 z-10">
            {{--overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400--}}
            <x-links.sidebar name="Dashboard" route="{{ route('dashboard') }}">
                <x-slot name="icon">
                    <x-bx-layout class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.dropdown-sidebar name="Categories">
                <x-slot name="icon">
                    <x-bx-collection class="h-5 w-5 mx-auto" />
                </x-slot>
                <x-slot name="content">
                    <x-links.dropdown-link href="#">
                        <span>Web Design</span>
                    </x-links.dropdown-link>
                    <x-links.dropdown-link href="#">
                        <span>Cards Design</span>
                    </x-links.dropdown-link>
                    <x-links.dropdown-link href="#">
                        <span>SEO Datas</span>
                    </x-links.dropdown-link>
                </x-slot>
            </x-links.dropdown-sidebar>
            <x-links.hr />
            <x-links.sidebar name="Posts" route="#">
                <x-slot name="icon">
                    <x-bx-book-alt class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.sidebar name="Analitics" route="#">
                <x-slot name="icon">
                    <x-bx-pie-chart-alt-2 class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.sidebar name="Charts" route="#">
                <x-slot name="icon">
                    <x-bx-line-chart class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.dropdown-sidebar name="Plugins">
                <x-slot name="icon">
                    <x-bx-plug class="h-5 w-5 mx-auto" />
                </x-slot>
                <x-slot name="content">
                    <x-links.dropdown-link href="#">
                        <span>UI Face</span>
                    </x-links.dropdown-link>
                    <x-links.dropdown-link href="#">
                        <span>Select2 Wire</span>
                    </x-links.dropdown-link>
                    <x-links.dropdown-link href="#">
                        <span>Icons UI</span>
                    </x-links.dropdown-link>
                </x-slot>
            </x-links.dropdown-sidebar>
            <x-links.sidebar name="Explorer" route="#">
                <x-slot name="icon">
                    <x-bx-compass class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.sidebar name="History" route="#">
                <x-slot name="icon">
                    <x-bx-history class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
            <x-links.sidebar name="Settings" route="#">
                <x-slot name="icon">
                    <x-bx-cog class="h-5 w-5 mx-auto" />
                </x-slot>
            </x-links.sidebar>
        </div>
        <form class="relative hover:bg-red-100 hover:text-red-800 transition-all duration-200 my-2" method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="flex items-center py-2" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="w-16">
                    <x-bx-log-out class="h-5 w-5 mx-auto text-red-500" />
                </span>
                <span class="link-name w-48 hidden lg:block">Logout</span>
            </a>
        </form>
    </div>
</div>
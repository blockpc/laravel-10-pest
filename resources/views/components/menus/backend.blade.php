@foreach (app('menus') as $route => $menu)
    @if ( !isset($menu['permission']) || current_user()->can($menu['permission']) )
        @if ( isset($menu['submenus']) && $menu['submenus'] )
        <x-links.sidebar-dropdown :active="request()->routeIs($menu['active'])">
            <x-slot name="trigger">
                <div class="flex space-x-2 items-center">
                    @if ( isset($menu['icon']) && $menu['icon'] )
                    @svg($menu['icon'], 'w-5 h-5')
                    @else
                    @svg('bx-link', 'w-5 h-5')
                    @endif
                    <span>{{__($menu['name'])}}</span>
                </div>
            </x-slot>
            <x-slot name="content">
                @foreach ($menu['submenus'] as $item)
                    @can($item['permission'])
                    <x-links.sidebar-submenu href="{{ route($item['href']) }}">
                        {{__($item['name'])}}
                    </x-links.sidebar-submenu>
                    @endcan
                @endforeach
            </x-slot>
        </x-links.sidebar-dropdown>
        @else
        <x-links.sidebar-link href="{{ route($menu['route']) }}" :active="request()->routeIs($menu['active'])">
            <div class="flex space-x-2 items-center">
                @if ( isset($menu['icon']) && $menu['icon'] )
                @svg($menu['icon'], 'w-5 h-5')
                @else
                @svg('bx-link', 'w-5 h-5')
                @endif
                <span>{{__($menu['name'])}}</span>
            </div>
        </x-links.sidebar-link>
        @endif
    @endif
@endforeach
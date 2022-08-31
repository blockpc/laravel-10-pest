<div>
    <x-dropdown align="right" width="64" :bx="false">
        <x-slot name="trigger">
            <button class="relative p-2 focus:bg-gray-100 dark:focus:bg-gray-600 focus:text-gray-600 dark:focus:text-gray-200 rounded-full">
                <span class="sr-only">{{__('common.notifications')}}</span>
                @if ( $this->unreadNotifications->count() )
                <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full"></span>
                <span class="absolute top-0 right-0 h-2 w-2 mt-1 mr-2 bg-red-500 rounded-full animate-ping"></span>
                @endif
                <x-bx-bell class="h-6 w-6" />
            </button>
        </x-slot>
        <x-slot name="content">
            @forelse ($this->unreadNotifications as $key => $unreadNotification)
                <button type="button" class="block px-4 py-2 text-xs hover:bg-gray-200 dark:hover:bg-gray-600" id="menu-item-{{$key}}" wire:click="mark_as_read('{{$unreadNotification->id}}')">
                    <div class="text-left">{{$unreadNotification->data['message']}}</div>
                </button>
            @empty
                <div class="block px-4 py-2 text-xs hover:bg-gray-200 dark:hover:bg-gray-600">
                    <span>{{__('common.no-notifications')}}</span>
                </div>
            @endforelse
        </x-slot>
    </x-dropdown>
</div>
<div>
    <div class=""><x-alert-wire /></div>
    <div class="flex-col space-y-4">
        <div class="flex flex-row">
            <div class="w-full mr-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <x-bx-search class="w-4 h-4 fill-current" />
                </div>
                <input wire:model.debounce.250ms="search" type="text" id="search" class="input-search" placeholder="Search" autocomplete="off">
                @if ( $search )
                <button type="button" wire:click="clean" class="absolute inset-y-0 right-16 flex items-center focus:ring-red-300 border-red-300 focus:border-red-300 text-red-500 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-current"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>
                </button>
                @endif
                <div class="absolute inset-y-0 right-0 flex items-center">
                    <select wire:model="paginate" id="paginate" name="paginate" class="focus:ring-gray-500 border-gray-500 focus:border-gray-400 h-full py-0 pl-2 pr-7 border-transparent bg-transparent dark:text-gray-200 text-gray-700 dark:bg-gray-600 sm:text-sm rounded-md">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">50</option>
                    </select>
                </div>
            </div>
            @if ( isset($records_deleted) && current_user()->can('user delete') )
                @if(!$records_deleted)
                <button wire:click="eliminated" type="button" class="btn-sm btn-danger flex fles-row items-center m-0 space-x-2 h-8">
                    <x-bx-trash class="w-4 h-4" />
                </button>
                @else
                <button wire:click="eliminated" type="button" class="btn-sm btn-success flex fles-row items-center m-0 space-x-2 h-8">
                    <x-bx-check class="w-4 h-4" />
                </button>
                @endif
            @endif
        </div>
        <div class="w-full scrollbar-thin scrollbar-thumb-gray-500 scrollbar-track-gray-400 overflow-x-scroll">
            <x-tables.table>
                <x-slot name="thead">
                    <tr>
                        <x-tables.th sortable field="name" :sortField="$sortField" :sortDirection="$sortDirection" wire:click="sortBy('name')">{{__('users.table.user')}}</x-tables.th>
                        <x-tables.th sortable field="email" :sortField="$sortField" :sortDirection="$sortDirection" wire:click="sortBy('email')">{{__('users.table.email')}}</x-tables.th>
                        <x-tables.th sortable field="email_verified_at" :sortField="$sortField" :sortDirection="$sortDirection" wire:click="sortBy('email_verified_at')">{{__('users.table.status')}}</x-tables.th>
                        <x-tables.th>{{__('users.table.role')}}</x-tables.th>
                        <th class="px-3 py-2">{{__('common.online')}}</th>
                        <th class="px-3 py-2 text-right">{{__('common.actions')}}</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($users as $user)
                    <x-tables.row wire:loading.class.delay="opacity-50">
                        <x-tables.td>{{ $user->name }}</x-tables.td>
                        <x-tables.td>{{ $user->email }}</x-tables.td>
                        <x-tables.td>
                            @if ( $user->email_verified_at )
                                <div class="btn-sm btn-success max-w-min font-semibold py-1 px-2 rounded-full text-xs">{{__('Verified')}}</div>
                            @else
                                <div class="btn-sm btn-danger max-w-min whitespace-pre font-semibold py-1 px-2 rounded-full text-xs">{{__('Not Verified')}}</div>
                            @endif
                        </x-tables.td>
                        <x-tables.td>
                            {{ $user->roles->pluck('display_name')->implode(', ') }}
                        </x-tables>
                        <x-tables.td>
                            <span class="text-sm">{{ $user->isOnline() ? 'Si' : 'No' }}</span>
                        </x-tables.td>
                        <x-tables.td>
                            <div class="flex justify-end space-x-2">
                                @if ( isset($records_deleted) && $records_deleted)
                                <div class="" x-data="{ showModal : false }">
                                    <button class="btn-sm btn-info" type="button" x-on:click="showModal = true" title="{{__('users.titles.restore')}}"><x-bx-revision class="w-4 h-4" /></button>
                                    <x-modals.mini class="w-full md:w-1/2 border-2 border-blue-800">
                                        <x-slot name="title">{{__('users.titles.restore')}}</x-slot>
                                        <x-slot name="action">
                                            <button x-on:click="showModal = false" class="btn btn-warning">{{__('common.cancel')}}</button>
                                            <button wire:click="restore({{$user->id}})" type="button" class="btn btn-primary" x-on:click="showModal = false">{{__('users.titles.restore')}}</button>
                                        </x-slot>
                                        <x-box-user :user=$user></x-box-user>
                                        <p>{{__('users.modals.restore')}}</p>
                                        <p>{{__('users.modals.restore-message')}}</p>
                                    </x-modals.mini>
                                </div>
                                @else
                                    @if ( current_user()->can('user update') )
                                    <a class="btn-sm btn-success" href="{{ route('users.edit', $user->name) }}"><x-bx-edit-alt class="w-4 h-4" /></a>
                                    @endif
                                    @if ( current_user()->can('user delete') && current_user()->id != $user->id )
                                    <div class="" x-data="{ showModal : false }">
                                        <button class="btn-sm btn-danger" type="button" x-on:click="showModal = true" title="{{__('users.titles.delete')}}"><x-bx-x class="w-4 h-4" /></button>
                                        <x-modals.mini class="w-full md:w-1/2 border-2 border-red-800">
                                            <x-slot name="title">{{__('users.titles.delete')}}</x-slot>
                                            <x-slot name="action">
                                                <button x-on:click="showModal = false" class="btn btn-warning">{{__('common.cancel')}}</button>
                                                <button wire:click="delete('{{$user->name}}')" type="button" class="btn btn-danger" x-on:click="showModal = false">{{__('users.titles.delete')}}</button>
                                            </x-slot>
                                            <x-box-user :user=$user></x-box-user>
                                            <p>{{__('users.modals.delete')}}</p>
                                        </x-modals.mini>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        </x-tables.td>
                    </x-tables.row>
                    @empty
                    <x-tables.row wire:loading.class.delay="opacity-50">
                        <x-tables.td class="font-semibold text-center" colspan="5">
                            <span>Sin registros encontrados
                                @if ($search)
                                    para <b>{{ $search }}</b>
                                @endif
                            </span>
                        </x-tables.td>
                    </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
        </div>
        <div class="w-full">
            {{ $users->links('layouts.backend.pagination') }}
        </div>
    </div>
</div>

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
            @error('error_role')
            <div class="alert-danger my-2" id="alert-message-error-role">
                <p class="text-sm">{!! $message !!}.</p>
            </div>
            @enderror
            <x-tables.table>
                <x-slot name="thead">
                    <tr>
                        <x-tables.th sortable field="name" :sortField="$sortField" :sortDirection="$sortDirection" wire:click="sortBy('name')">{{__('roles.table.name')}}</x-tables.th>
                        <x-tables.th sortable field="guard_name" :sortField="$sortField" :sortDirection="$sortDirection" wire:click="sortBy('guard_name')">{{__('roles.table.guard_name')}}</x-tables.th>
                        <x-tables.th sortable field="display_name" :sortField="$sortField" :sortDirection="$sortDirection" wire:click="sortBy('display_name')">{{__('roles.table.display_name')}}</x-tables.th>
                        <x-tables.th>{{__('roles.table.users_count')}}</x-tables.th>
                        <th class="px-3 py-2 text-right">{{__('roles.table.actions')}}</th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @forelse ($this->roles as $role)
                    <x-tables.row wire:loading.class.delay="opacity-50">
                        <x-tables.td>{{ $role->name }}</x-tables.td>
                        <x-tables.td>{{ $role->guard_name }}</x-tables.td>
                        <x-tables.td>{{ $role->display_name }}</x-tables.td>
                        <x-tables.td>{{ $role->users_count }}</x-tables.td>
                        <x-tables.td>
                            <div class="flex justify-end space-x-2">
                                @if ( isset($records_deleted) && $records_deleted)
                                    @if ( current_user()->can('role restore') )
                                    <div class="" x-data="{ showModal : false }">
                                        <button class="btn-sm btn-info" type="button" x-on:click="showModal = true" title="{{__('roles.titles.restore')}}"><x-bx-revision class="w-4 h-4" /></button>
                                        <x-modals.mini class="border-2 border-blue-800">
                                            <x-slot name="title">{{__('roles.titles.restore')}}</x-slot>
                                            <x-slot name="action">
                                                <button x-on:click="showModal = false" class="btn btn-warning">{{__('common.cancel')}}</button>
                                                <button wire:click="restore({{$role->id}})" type="button" class="btn btn-primary" x-on:click="showModal = false">{{__('roles.titles.restore')}}</button>
                                            </x-slot>
                                            <p>{{__('roles.modals.restore')}}</p>
                                            <p>{{__('roles.modals.restore-message')}}</p>
                                            <p class="text-xl font-semibold">{{$role->display_name}}</p>
                                        </x-modals.mini>
                                    </div>
                                    @endif
                                @else
                                    @if ( current_user()->can('role update') )
                                    <a class="btn-sm btn-success" href="{{ route('roles.edit', [$role]) }}" title="{{ __('roles.titles.update') }}">
                                        <x-bx-edit-alt class="w-4 h-4" />
                                    </a>
                                    @endif
                                    @if ( !in_array($role->name, $roles_base) && current_user()->can('role delete') && !current_user()->hasRole($role->name) )
                                    <div class="" x-data="{ showModal : false }">
                                        <button class="btn-sm btn-danger" type="button" x-on:click="showModal = true" title="{{__('roles.titles.delete')}}"><x-bx-x class="w-4 h-4" /></button>
                                        <x-modals.mini class="border-2 border-red-800">
                                            <x-slot name="title">{{__('roles.titles.delete')}}</x-slot>
                                            <x-slot name="action">
                                                <button x-on:click="showModal = false" class="btn btn-warning">{{__('common.cancel')}}</button>
                                                <button wire:click="delete('{{$role->id}}')" type="button" class="btn btn-danger" x-on:click="showModal = false">{{__('roles.titles.delete')}}</button>
                                            </x-slot>
                                            <p>{{__('roles.modals.delete')}}</p>
                                            <p class="text-xl font-semibold">{{$role->display_name}}</p>
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
                            <span>{{__('common.no-records-founds')}}</span>
                        </x-tables.td>
                    </x-tables.row>
                    @endforelse
                </x-slot>
            </x-tables.table>
        </div>
        <div class="w-full">
            {{ $this->roles->links('layouts.backend.pagination') }}
        </div>
        @if ( current_user()->can('role delete') )
        <div class="text-xs text-center">Los cargos <b>Administrador</b> y <b>Usuario</b> no se pueden <b class="text-red-400">eliminar</b>, por ser los cargos base del sistema.</div>
        @endif
    </div>
</div>

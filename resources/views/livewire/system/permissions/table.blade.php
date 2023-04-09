<div>
    <div class="md:flex mb-8">
        <div class="md:w-1/3 flex-col md:space-y-2">
            <legend class="uppercase tracking-wide text-sm">{{__('roles.forms.permissions.title')}}</legend>
            <p class="text-xs font-light">{{__('roles.forms.permissions.legend')}}</p>
        </div>
        <div class="md:flex-1 mt-2 mb:mt-0 md:px-3 shadow-lg pb-4">
            {{-- Select Role --}}
            @if ( $user->hasRole(['sudo', 'admin']))
            <x-forms.box-select name="select_role" title="users.forms.create.select-role" :options="$this->roles" wire:model="role" />
            @endif
        </div>
    </div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($permissions as $group => $collection)
        <div class="overflow-hidden w-full dark:text-gray-200 text-gray-700">
            <div class="w-full p-2 text-sm rounded-lg font-semibold dark:bg-gray-900 bg-gray-200">{{__('permissions.'.$group.'.title')}}</div>
            <div class="">
                @foreach ($collection as $id => $permission)
                <div class="flex space-x-2 items-center p-2">
                    <div class="mb-auto">
                        @if ( isset($role_permissions[$id]) )
                            <x-bx-check class="w-8 h-8 text-green-700 font-semibold" />
                        @else
                            <x-bx-x class="w-8 h-8 text-red-500 font-semibold" />
                        @endif
                    </div>
                    <div class="flex flex-col space-y-1">
                        <span class="text-sm">{{$permission->display_name}}</span>
                        <span class="text-xs">{{$permission->description}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

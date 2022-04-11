<div>
    <div class="md:flex mb-8">
        <div class="md:w-1/3 flex-col md:space-y-2">
            <legend class="uppercase tracking-wide text-sm">{{__('roles.forms.permissions.title')}}</legend>
            <p class="text-xs font-light text-red">{{__('roles.forms.permissions.legend')}}</p>
        </div>
        <div class="md:flex-1 mt-2 mb:mt-0 md:px-3 shadow-lg pb-4">
            {{-- Select Role --}}
            @if ( $user->hasRole(['sudo', 'admin']))
            <x-forms.box-select name="select_role" title="users.forms.create.select-role" :options="$this->roles" wire:model="role" />
            @endif

            <div class="">
                @foreach ($permissions as $group => $collection)
                <div class="my-2 overflow-hidden w-full dark:text-gray-200 text-gray-700">
                    <div class="w-full p-2 text-sm rounded-lg font-semibold dark:bg-gray-900 bg-gray-200">{{__(title($group.'.titles.link'))}}</div>
                    <div class="grid grid-cols-2 gap-4 px-4">
                        @foreach ($collection as $id => $permission)
                        <div class="col-span-1 flex flex-col space-y-2 p-2">
                            <div class="flex space-x-2 items-center">
                                @if ( isset($role_permissions[$id]) )
                                    <x-bx-check class="w-5 h-5 text-green-700 font-semibold" />
                                @else
                                    <x-bx-x class="w-5 h-5 text-red-500 font-semibold" />
                                @endif
                                <span class="text-sm">{{$permission->display_name}}</span>
                            </div>
                            <span class="text-xs">{{$permission->description}}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

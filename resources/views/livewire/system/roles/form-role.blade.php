<div>
    <x-loading wire:target="save, resend" :title="$title_loading">
        {{__('common.load-message')}}
    </x-loading>

    <div class=""><x-alert-wire /></div>

    <form wire:submit.prevent="save">
        <div class="md:flex mb-8">
            <div class="md:w-1/3 flex-col md:space-y-2">
                <legend class="uppercase tracking-wide text-sm">{{__('roles.forms.attributes.title')}}</legend>
                <p class="text-xs font-light">{{__('roles.forms.attributes.legend')}}</p>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3 shadow-lg pb-4">
                <div class="grid gap-4">
                    {{-- Alias Role --}}
                    <x-forms.box-text name="role_name" title="roles.forms.attributes.role.name" wire:model.defer="role.name" required />

                    {{-- Display name --}}
                    <x-forms.box-text name="display_name" title="roles.forms.attributes.role.display_name" wire:model.defer="role.display_name" required />

                    {{-- Description --}}
                    <x-forms.box-text name="role_description" title="roles.forms.attributes.role.description" wire:model.defer="role.description" />
                </div>
            </div>
        </div>
        <div class="md:flex mb-8">
            <div class="md:w-1/3">
                <legend class="uppercase tracking-wide text-sm"></legend>
                <p class="text-xs font-light"></p>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
                <div class="grid grid-cols-3">
                    <div class="hidden md:block col-span-1"></div>
                    <div class="col-span-3 md:col-span-2">
                        {{-- buttons --}}
                        <div class="flex items-center justify-between">
                            <a href="{{ route('roles.index') }}" class="btn-sm btn-warning cursor-pointer">{{__('common.cancel')}}</a>
                            @if ($role->exists)
                            <button class="btn-sm btn-success">{{ __('roles.forms.create.edit-role') }}</button>
                            @else
                            <button class="btn-sm btn-primary">{{ __('roles.forms.create.create-role') }}</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:flex mb-8">
            <div class="md:w-1/3 flex-col md:space-y-2">
                <legend class="uppercase tracking-wide text-sm">{{__('roles.forms.permissions.title')}}</legend>
                <p class="text-xs font-light">{{__('roles.forms.permissions.legend')}}</p>
            </div>
            <div class="md:flex-1 grid grid-cols-3 gap-4">
                @foreach ($permissions as $group => $collection)
                <div class="overflow-hidden w-full dark:text-gray-200 text-gray-700">
                    <div class="w-full p-2 text-sm rounded-lg font-semibold dark:bg-gray-900 bg-gray-200">{{__('permissions.'.$group.'.title')}}</div>
                    <div class="">
                        @foreach ($collection as $id => $permission)
                        <div class="flex space-x-2 items-center p-2">
                            <div class="mb-auto">
                                <input wire:model.lazy="role_permissions.{{$id}}" id="permission-{{$group}}-{{$id}}" type="checkbox" class="checkbox" value="{{$permission->name}}">
                            </div>
                            <label class="flex flex-col space-y-1" for="permission-{{$group}}-{{$id}}">
                                <span class="text-sm">{{$permission->display_name}}</span>
                                <span class="text-xs">{{$permission->description}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>

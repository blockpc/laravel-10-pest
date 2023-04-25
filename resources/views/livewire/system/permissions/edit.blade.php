<div>
    <div class="" x-data="{showModal: @entangle('show')}">
        <button type="button" class="btn-sm btn-action text-green-500" wire:click="show">
            <x-bx-pencil class="w-4 h-4" />
        </button>
        <x-modals.mini class="w-full md:w-1/2 border-2 border-green-500">
            <x-slot name="title">Editar Permiso</x-slot>
            <x-slot name="action"></x-slot>
            <form wire:submit.prevent="save">
                <div class="flex flex-col space-y-4">
                    {{-- Nombre del Permiso --}}
                    <x-forms.box-text name="display_name_{{ $permission->id }}" title="Nombre del Permiso" wire:model.defer="permission.display_name" required />

                    {{-- Description --}}
                    <x-forms.box-textarea name="permission_description_{{ $permission->id }}" title="Descripción del Permiso" wire:model.defer="permission.description" />

                    <div class="flex justify-end space-x-2">
                        <button type="button" class="btn-sm btn-cancel" wire:click="hide">{{__('common.cancel')}}</button>
                        @if ($permission->exists)
                        <button class="btn-sm btn-success">{{ __('common.save') }}</button>
                        @endif
                    </div>
                </div>
            </form>
        </x-modals.mini>
    </div>

</div>

<div>
    <x-loading wire:target="save, resend">
        <x-slot name="title">{{$title_loading}}</x-slot>
        {{__('common.load-message')}}
    </x-loading>

    <form wire:submit.prevent="save">
        <div class="md:flex mb-8">
            <div class="md:w-1/3 flex-col md:space-y-2">
                <legend class="uppercase tracking-wide text-sm">{{__('users.forms.attributes.title')}}</legend>
                <p class="text-xs font-light text-red">{{__('users.forms.attributes.legend')}}</p>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3 shadow-lg pb-4">
                <div class="grid gap-4">
                    {{-- User Name --}}
                    <x-forms.box-text name="user_name" title="users.forms.attributes.user.name" wire:model.defer="user.name" required />
        
                    {{-- User email --}}
                    <x-forms.box-text name="user_email" title="users.forms.attributes.user.email" wire:model.defer="user.email" required />

                    {{-- Profile Firstname --}}
                    <x-forms.box-text name="profile_firstname" title="users.forms.attributes.profile.firstname" wire:model.defer="profile.firstname" />
        
                    {{-- Profile Lastname --}}
                    <x-forms.box-text name="profile_lastname" title="users.forms.attributes.profile.lastname" wire:model.defer="profile.lastname" />
        
                    {{-- Profile Phone --}}
                    <x-forms.box-text name="profile_phone" title="users.forms.attributes.profile.phone" wire:model.defer="profile.phone" />
        
                    {{-- Select Role --}}
                    <x-forms.box-select name="select_role" title="users.forms.create.select-role" :options="$roles" wire:model.defer="role" />
                </div>
            </div>
        </div>
        <div class="md:flex mb-8">
            <div class="md:w-1/3">
                <legend class="uppercase tracking-wide text-sm"></legend>
                <p class="text-xs font-light text-red"></p>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3">
                <div class="grid grid-cols-3">
                    <div class="hidden md:block col-span-1"></div>
                    <div class="col-span-3 md:col-span-2">
                        {{-- buttons --}}
                        <div class="flex items-center justify-between">
                            @if ($user->exists)
                            <button class="btn-sm btn-success">{{ __('users.forms.create.edit-user') }}</button>
                            @else
                            <button class="btn-sm btn-primary">{{ __('users.forms.create.create-user') }}</button>
                            @endif
                            <a href="{{ route('users.index') }}" class="btn-sm btn-warning cursor-pointer">{{__('common.cancel')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if ( $user->exists )
    <div class="md:flex mb-8">
        <div class="md:w-1/3 flex-col md:space-y-2">
            <legend class="uppercase tracking-wide text-sm">{{__('users.forms.create.send-pass')}}</legend>
        </div>
        <div class="md:flex-1 mt-2 mb:mt-0 md:px-3 shadow-lg pb-4">
            <div class="grid gap-4">
                <div class="flex justify-end space-x-2">
                    <p class="text-xs font-light text-red">{{__('users.forms.create.send-message')}}</p>
                    <button type="button" class="btn-sm btn-primary whitespace-pre" wire:click="resend">{{ __('users.forms.create.send-link') }}</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

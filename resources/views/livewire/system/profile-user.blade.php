<div>
    <x-loading wire:target="save_profile, change_password">
        <x-slot name="title">{{__('pages.profile.title')}}</x-slot>
        {{__('common.load-message')}}
    </x-loading>

    <div class="w-full">
        <form wire:submit.prevent="save_profile">
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

                        {{-- Upload Photo --}}
                        <div class="flex flex-col md:flex-row text-xs md:text-sm items-center">
                            <label class="w-full md:w-1/3" for="profile_image">{{__('common.upload-photo')}}</label>
                            <div class="flex flex-col space-y-2 w-full md:w-2/3 mt-1 md:mt-0">
                                <div class="flex flex-1 space-x-2">
                                    <div class="flex items-center h-20 w-20 rounded-full overflow-hidden">
                                        @if ($photo)
                                            <img class="h-16 w-16 rounded-full" src="{{ $photo->temporaryUrl() }}">
                                        @else
                                            <img class="h-16 w-16 rounded-full" src="{{ image_profile() }}">
                                        @endif
                                    </div>
                                    <div class="overflow-hidden relative w-64 md:w-full my-auto" 
                                        x-data="{ isUploading: false, progress: 0 }"
                                        x-on:livewire-upload-start="isUploading = true"
                                        x-on:livewire-upload-finish="isUploading = false"
                                        x-on:livewire-upload-error="isUploading = false"
                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                        <button type="button" class="text-dark font-bold py-2 px-4 w-full inline-flex items-center bg-gray-200 dark:bg-gray-600 rounded-md h-8">
                                            <x-heroicon-o-upload class="h-4 w-4"/>
                                            <div class="ml-2 flex w-full justify-between items-center">
                                                <span class="whitespace-pre">{{__('common.upload-photo')}}</span>
                                                @if ( $photo )
                                                <span class="ml-2 xl:text-xs">{{ $photo->getClientOriginalName()}}</span>
                                                @endif
                                            </div>
                                        </button>
                                        <input class="cursor-pointer absolute block py-2 px-4 w-full opacity-0 top-0 h-8" type="file"  wire:model="photo" accept="image/*">
                                        <!-- Progress Bar -->
                                        <div class="px-2 pt-2" x-show="isUploading">
                                            <progress class="w-full" max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </div>
                                @error('photo')
                                    <div class="text-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row text-xs md:text-sm items-center">
                            <div class="w-full md:w-1/3"></div>
                            <div class="flex justify-end w-full md:w-2/3 mt-1 md:mt-0">
                                <button class="btn-sm btn-primary">{{__('common.profile-save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="w-full">
        <div class="md:flex mb-8">
            <div class="md:w-1/3 flex-col md:space-y-2">
                <legend class="uppercase tracking-wide text-sm">{{__('users.forms.attributes.change-pass')}}</legend>
                <p class="text-xs font-light text-red">{{__('users.forms.attributes.change-pass-legend')}}</p>
            </div>
            <div class="md:flex-1 mt-2 mb:mt-0 md:px-3 shadow-lg pb-4">
                <div class="grid gap-4">
                    {{-- password --}}
                    <x-forms.box-text type="password" name="profile_password" title="users.forms.attributes.user.new-password" wire:model.defer="password" />

                    {{-- confirm password --}}
                    <x-forms.box-text type="password" name="profile_password_confirmation" title="users.forms.attributes.user.password-confirmation" wire:model.defer="password_confirmation" />

                    <div class="flex flex-col md:flex-row text-xs md:text-sm items-center">
                        <div class="w-full md:w-1/3"></div>
                        <div class="flex justify-between w-full md:w-2/3 mt-1 md:mt-0">
                            <button wire:click="generate" type="button" class="btn-sm btn-default space-x-2" title="{{__('common.gen-password')}}">
                                <x-heroicon-o-key class="h-4 w-4" />
                                <span class="hidden sm:block">{{__('common.gen-password')}}</span>
                            </button>
                            <button type="button" class="btn-sm btn-primary" wire:click.prevent="change_password">{{__('common.change-password')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

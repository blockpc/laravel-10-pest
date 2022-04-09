<div>
    @if ( session()->has('error') && $flash = session('error') )
    <div class="alert-danger">
        <p class="font-bold">Error!</p>
        <p class="text-sm">{!! $flash !!}.</p>
    </div>
    @endif
    <div class="mt-4">
        <form wire:submit.prevent="save">
            {{-- User email --}}
            <div class="flex flex-col text-xs md:text-sm">
                <label class="" for="email">{{__('User email')}}</label>
                <input wire:model.defer="email" id="email" class="input input-sm mt-1 @error('email') border-error @enderror" type="email" placeholder="{{__('User email')}}" required />
                @error('email')
                    <div class="text-error">{{$message}}</div>
                @enderror
            </div>
            {{-- New Password --}}
            <div class="flex flex-col text-xs md:text-sm mt-4">
                <label class="" for="new_password">{{__('New Password')}}</label>
                <input wire:model.defer="password" id="new_password" class="input input-sm mt-1 @error('password') border-error @enderror" type="password" placeholder="{{__('New Password')}}" required />
                @error('password')
                    <div class="text-error">{{$message}}</div>
                @enderror
            </div>
            {{-- Password Confirmation --}}
            <div class="flex flex-col text-xs md:text-sm mt-4">
                <label class="" for="password_confirm">{{__('Password Confirmation')}}</label>
                <input wire:model.defer="password_confirmation" id="password_confirm" class="input input-sm mt-1 @error('password_confirmation') border-error @enderror" type="password" placeholder="{{__('Password Confirmation')}}" required />
                @error('password_confirmation')
                    <div class="text-error">{{$message}}</div>
                @enderror
            </div>
            <div class="w-full mt-4">
                {{-- buttons --}}
                <button class="btn-sm btn-primary text-sm">{{ __('Create Password') }}</button>
            </div>
        </form>
    </div>
</div>

@extends('layouts.guest.app')

@section('content')
    <div class="mt-8 flex flex-col justify-center w-full md:max-w-sm items-center mx-auto">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form class="w-full" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block h-8 text-sm mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block h-8 text-sm mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Firstname -->
            <div class="mt-4">
                <x-label for="firstname" :value="__('FirstName')" />

                <x-input id="firstname" class="block h-8 text-sm mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus />
            </div>

            <!-- Lastname -->
            <div class="mt-4">
                <x-label for="lastname" :value="__('LastName')" />

                <x-input id="lastname" class="block h-8 text-sm mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block h-8 text-sm mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block h-8 text-sm mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-dark" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </div>
@endsection

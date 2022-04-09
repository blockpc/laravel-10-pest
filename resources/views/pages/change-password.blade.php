@extends('layouts.guest.app')

@section('header', __('Change Password'))

@section('content')
<x-auth-card>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current" />
        </a>
    </x-slot>
    <div class="">
        @livewire('pages.change-password', ['token' => $token], key($token))
    </div>
</x-auth-card>
@endsection
@extends('layouts.backend.app')

@section('title', __('users.titles.profile'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-user-pin class="w-6 h-6" />
            <span>{{__('users.titles.profile')}}</span>
        </div>
        <div class="">
            <a class="btn-sm btn-default space-x-2" href="{{ route('dashboard') }}" title="{{__('pages.dashboard.titles.link')}}">
                <x-bx-layout class="w-4 h-4" />
                <span class="hidden sm:block">{{__('pages.dashboard.titles.link')}}</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        @livewire('system.profile-user', [], key('system-profile-user'))
    </div>
</div>
@endsection
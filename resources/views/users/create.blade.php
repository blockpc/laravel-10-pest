@extends('layouts.backend.app')

@section('title', __('users.titles.create'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-heroicon-s-user class="w-6 h-6" />
            <span>{{__('users.titles.create')}}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <a class="btn-sm btn-primary space-x-2" href="{{ route('users.index') }}" title="{{__('users.titles.list')}}">
                <x-heroicon-s-users class="w-4 h-4" />
                <span class="hidden sm:block">{{__('users.titles.list')}}</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        @livewire('system.users.form-user', [], key('system-users-form-user'))
    </div>
</div>
@endsection
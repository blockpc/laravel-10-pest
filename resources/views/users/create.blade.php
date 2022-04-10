@extends('layouts.backend.app')

@section('title', __('users.titles.create'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-6 h-6" />
            <span>{{__('users.titles.create')}}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <a class="btn-sm btn-primary" href="{{ route('users.index') }}" title="{{__('users.titles.list')}}">
                <x-bx-layout class="w-6 h-6" />
                <span class="hidden sm:block">{{__('users.titles.list')}}</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        @livewire('system.users.form-user', [], key('system-users-form-user'))
    </div>
</div>
@endsection
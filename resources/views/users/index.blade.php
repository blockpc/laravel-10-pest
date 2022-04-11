@extends('layouts.backend.app')

@section('title', __('users.titles.list'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-heroicon-s-users class="w-6 h-6" />
            <span>{{__('users.titles.list')}}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <a class="btn-sm btn-default space-x-2" href="{{ route('users.create') }}" title="{{__('users.titles.add')}}">
                <x-bx-plus class="w-4 h-4" />
                <span class="hidden sm:block">{{__('users.titles.add')}}</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        @livewire('system.users.table', [], key('system-users-table'))
    </div>
</div>
@endsection
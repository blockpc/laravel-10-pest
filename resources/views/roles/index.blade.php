@extends('layouts.backend.app')

@section('title', __('roles.titles.list'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-shield class="w-6 h-6" />
            <span>{{__('roles.titles.list')}}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <a class="btn-sm btn-default space-x-2" href="{{ route('roles.create') }}" title="{{__('roles.titles.add')}}">
                <x-bx-plus class="w-4 h-4" />
                <span class="hidden sm:block">{{__('roles.titles.add')}}</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        @livewire('system.roles.table', [], key('system-roles-table'))
    </div>
</div>
@endsection
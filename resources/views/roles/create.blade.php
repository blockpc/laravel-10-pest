@extends('layouts.backend.app')

@section('title', __('roles.titles.create'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-shield class="w-6 h-6" />
            <span>{{__('roles.titles.create')}}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <a class="btn-sm btn-primary space-x-2" href="{{ route('roles.index') }}" title="{{__('roles.titles.list')}}">
                <x-bx-shield class="w-4 h-4" />
                <span class="hidden sm:block">{{__('roles.titles.list')}}</span>
            </a>
        </div>
    </div>
    <div class="page-content">
        @livewire('system.roles.form-role', [], key('system-roles-form-role'))
    </div>
</div>
@endsection
@extends('layouts.backend.app')

@section('title', __('permissions.titles.list'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-label class="w-6 h-6" />
            <span>{{__('permissions.titles.list')}}</span>
        </div>
        <div class="flex space-x-2 items-center"></div>
    </div>
    <div class="page-content">
        @livewire('system.permissions.table', [], key('system-permissions-table'))
    </div>
</div>
@endsection
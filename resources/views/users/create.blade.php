@extends('layouts.backend.app')

@section('title', __('pages.users.titles.create'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-6 h-6" />
            <span>{{__('pages.users.titles.create')}}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <a class="btn-sm btn-primary" href="{{ route('users.index') }}">{{__('pages.users.titles.list')}}</a>
        </div>
    </div>
    <div class="page-content">
        <p class="">Lista Usuarios.</p>
    </div>
</div>
@endsection
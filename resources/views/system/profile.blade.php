@extends('layouts.backend.app')

@section('title', __('pages.users.titles.profile'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-6 h-6" />
            <span>{{__('pages.users.titles.profile')}}</span>
        </div>
        <div class=""></div>
    </div>
    <div class="page-content">
        <p class="mt-4">Perfil Usuario.</p>
    </div>
</div>
@endsection
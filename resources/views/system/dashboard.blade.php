@extends('layouts.backend.app')

@section('title', 'Dashboard')

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-6 h-6" />
            <span>{{__('Dashboard')}}</span>
        </div>
        <div class=""></div>
    </div>
    <div class="mt-2">
        <p class="">Vista Usuario.</p>
    </div>
</div>
@endsection

@extends('layouts.backend.app')

@section('title', __('pages.dashboard.titles.link'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    <div class="page-header">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-6 h-6" />
            <span>{{__('pages.dashboard.titles.link')}}</span>
        </div>
        <div class=""></div>
    </div>
    <div class="page-content">
        <p class="">Escritorio Usuario.</p>
    </div>
</div>
@endsection

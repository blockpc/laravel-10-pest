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
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="flex items-center p-4 shadow rounded-md border border-light">
                <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <x-heroicon-o-user-group class="h-8 w-8" />
                </div>
                <div>
                    <span class="block text-2xl font-bold text-light">{{ $users->count() }}</span>
                    <span class="block">{{ __('common.users')}}</span>
                </div>
            </div>
            <div class="flex items-center p-4 shadow rounded-md border border-light">
                <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                    <x-heroicon-o-user-group class="h-8 w-8" />
                </div>
                <div>
                    <span class="block text-2xl font-bold text-light">{{ $online }}</span>
                    <span class="block">{{ __('common.users-online')}}</span>
                </div>
            </div>
        </div>
        <div class="">
            @foreach (app('menus') as $menus)
                <p>{{$menus}}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection

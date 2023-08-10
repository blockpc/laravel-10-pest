@extends('layouts.backend.app')

@section('title', __('book::book.name'))

@section('content')

<div class="page-header">
    <p>{{__('book::book.name')}}</p>
</div>
<div class="page-content">
    <div class="grid md:grid-cols-3 gap-4">
        <div class="col-span-1">
            <x-menus.parameter :first="true">My Feed</x-parameter>
            <x-menus.parameter :route="route('book.index')" :active="request()->routeIs('book.index')">My Books</x-parameter>
            <x-menus.parameter :last="true" :route="route('friend.index')" :active="request()->routeIs('friend.index')">My Friends</x-parameter>
        </div>
        <div class="col-span-2 flex flex-col space-y-4">
            @include('layouts.backend.messages')
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">My Friends</h2>
                <a class="btn-sm btn-default space-x-2" href="{{ route('book.create') }}">
                    <x-bx-plus class="w-4 h-4" />
                    <span>Add New</span>
                </a>
            </div>
            <div class="flex flex-col space-y-4">
                @foreach (\App\Models\User::class::all() as $friend)
                    <x-friend :friend="$friend">
                        <x-slot name="links">
                            link
                            {{-- <a class="btn-sm btn-success" href="{{ route('book.edit', $user->id) }}">Edit</a> --}}
                        </x-slot>
                    </x-friend>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

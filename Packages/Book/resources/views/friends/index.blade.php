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
                <h2 class="text-lg font-semibold">Accepted Friends</h2>
                <a class="btn-sm btn-default space-x-2" href="{{ route('friend.add') }}">
                    <x-bx-plus class="w-4 h-4" />
                    <span>Add a Friend</span>
                </a>
            </div>
            <div class="flex flex-col space-y-4">
                @forelse ($acceptedFriendOfMines as $acceptedFriendOfMine)
                    <x-friend :friend="$acceptedFriendOfMine">
                        <x-slot name="links">
                            link
                            {{-- <a class="btn-sm btn-success" href="{{ route('book.edit', $user->id) }}">Edit</a> --}}
                        </x-slot>
                    </x-friend>
                @empty
                <div class="bg-slate-100 p-3 rounded flex justify-between items-center">
                    <span class="text-sm text-slate-600">No accepted friends</span>
                </div>
                @endforelse
            </div>

            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Pending friends requests</h2>
            </div>
            <div class="flex flex-col space-y-4">
                @forelse ($pendingFriendOfMines as $pendingFriendOfMine)
                    <x-friend :friend="$pendingFriendOfMine">
                        <x-slot name="links">
                            link
                            {{-- <a class="btn-sm btn-success" href="{{ route('book.edit', $user->id) }}">Edit</a> --}}
                        </x-slot>
                    </x-friend>
                @empty
                <div class="bg-slate-100 p-3 rounded flex justify-between items-center">
                    <span class="text-sm text-slate-600">No pending friend request</span>
                </div>
                @endforelse
            </div>

            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Friends requests</h2>
            </div>
            <div class="flex flex-col space-y-4">
                @forelse ($pendingFriendOfs as $pendingFriendOf)
                    <x-friend :friend="$pendingFriendOf">
                        <x-slot name="links">
                            link
                            {{-- <a class="btn-sm btn-success" href="{{ route('book.edit', $user->id) }}">Edit</a> --}}
                        </x-slot>
                    </x-friend>
                @empty
                <div class="bg-slate-100 p-3 rounded flex justify-between items-center">
                    <span class="text-sm text-slate-600">No friends request</span>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

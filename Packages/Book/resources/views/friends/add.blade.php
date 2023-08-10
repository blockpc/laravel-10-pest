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
                <h2 class="text-lg font-semibold">Add a Friend</h2>
                <a class="btn-sm btn-default space-x-2" href="{{ route('friend.index') }}">
                    <span>My Friends</span>
                </a>
            </div>

            <form action="{{ route('friend.store') }}" method="POST">
                @csrf
                <div class="flex flex-col lg:flex-row text-xs font-semibold lg:text-sm space-y-2 sm:space-y-0">
                    <label class="w-full lg:w-1/3 label" for="email">{{__('Email Friend')}} </label>
                    <div class="flex flex-col space-y-1 w-full lg:w-2/3 mt-1 lg:mt-0">
                        <input name="email" id="email" class="input input-sm @error( 'email' ) border-error @enderror" type="email" placeholder="{{__('Email Friend')}}" value="{{ old('email') }}" />
                        @error( 'email' )
                            <div class="text-error">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button class="btn-sm btn-primary">Send Request</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

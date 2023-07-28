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
            <x-menus.parameter :route="route('book.create')" :active="request()->routeIs('book.create')">My Books</x-parameter>
            <x-menus.parameter :last="true">My Friends</x-parameter>
        </div>
        <div class="col-span-2">
            <div class="flex justify-between items-center">
                <h2>New Book</h2>
                <a href="{{ route('book.index') }}">My Books</a>
            </div>
        </div>
    </div>
</div>

@endsection

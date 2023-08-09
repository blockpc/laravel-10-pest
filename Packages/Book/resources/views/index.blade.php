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
            <x-menus.parameter :last="true">My Friends</x-parameter>
        </div>
        <div class="col-span-2 flex flex-col space-y-4">
            @include('layouts.backend.messages')
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">My Books</h2>
                <a class="btn-sm btn-default space-x-2" href="{{ route('book.create') }}">
                    <x-bx-plus class="w-4 h-4" />
                    <span>Add New</span>
                </a>
            </div>
            <div class="flex flex-col space-y-4">
                @foreach ($booksByStatuses as $status => $books)
                <div class="flex flex-col space-y-4">
                    <div class="col-span-2">
                        <h2 class="text-ls font-semibold">{{ \Packages\Book\App\Models\Pivots\BookUser::$statuses[$status] }}</h2>
                    </div>
                    @forelse ($books as $book)
                        <x-book :book="$book">
                            <x-slot name="links">
                                <a class="btn-sm btn-success" href="{{ route('book.edit', $book->id) }}">Edit</a>
                            </x-slot>
                        </x-book>
                    @empty
                        <div class="col-span-2">No Books finded</div>
                    @endforelse
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

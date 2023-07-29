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
        <div class="col-span-2 flex flex-col space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold">Add a Book</h2>
                <a class="btn-sm btn-default space-x-2" href="{{ route('book.index') }}">
                    <x-bx-left-arrow-alt class="w-4 h-4" />
                    <span>My Books</span>
                </a>
            </div>
            <div class="">
                <form action="{{ route('book.store') }}" method="POST">
                @csrf
                    <div class="flex flex-col space-y-2">
                        <div class="flex flex-col lg:flex-row text-xs font-semibold lg:text-sm space-y-2 sm:space-y-0">
                            <label class="w-full lg:w-1/3 label" for="title">{{__('Title')}} </label>
                            <div class="flex flex-col space-y-1 w-full lg:w-2/3 mt-1 lg:mt-0">
                                <input name="title" id="title" class="input input-sm @error( 'title' ) border-error @enderror" type="text" placeholder="{{__('Title')}}" />
                                @error( 'title' )
                                    <div class="text-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row text-xs font-semibold lg:text-sm space-y-2 sm:space-y-0">
                            <label class="w-full lg:w-1/3 label" for="author">{{__('Author')}} </label>
                            <div class="flex flex-col space-y-1 w-full lg:w-2/3 mt-1 lg:mt-0">
                                <input name="author" id="author" class="input input-sm @error( 'author' ) border-error @enderror" type="text" placeholder="{{__('Author')}}" />
                                @error( 'author' )
                                    <div class="text-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row text-xs font-semibold lg:text-sm space-y-2 sm:space-y-0">
                            <label class="w-full lg:w-1/3 label" for="status">{{__('Status')}} </label>
                            <div class="flex flex-col space-y-1 w-full lg:w-2/3 mt-1 lg:mt-0">
                                {{-- <input name="author" id="author" class="input input-sm @error( 'author' ) border-error @enderror" type="text" placeholder="{{__('Author')}}" /> --}}
                                <select class="select-sm text-sm @error( 'status' ) border-error @enderror" name="status" id="status">
                                    <option value="">{{ __('common.select') }}</option>
                                    @foreach (\Packages\Book\App\Models\Pivots\BookUser::$statuses as $key => $status)
                                    <option value="{{ $key }}">{{ __($status) }}</option>
                                    @endforeach
                                </select>
                                @error( 'status' )
                                    <div class="text-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end mt-4">
                        <button class="btn-sm btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

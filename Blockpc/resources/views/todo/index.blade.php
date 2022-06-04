@extends('layouts.backend.app')

@section('title', __('users.titles.list'))

@section('content')
<div class="overflow-hidden shadow-sm sm:rounded-lg">
    @livewire('blockpc::todo-table', [], key('system-todo-table'))
</div>
@endsection
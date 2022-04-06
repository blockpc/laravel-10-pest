@extends('layouts.backend.app')

@section('title', 'Perfil Usuario')

@section('content')
<div class="bg-dark overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-4 bg-dark border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
        <div class="flex space-x-2 items-center">
            <x-bx-layout class="w-6 h-6" />
            <span>{{__('Perfil Usuario')}}</span>
        </div>
        <div class=""></div>
    </div>
    <div class="">
        <p class="mt-4">Perfil Usuario.</p>
    </div>
</div>
@endsection
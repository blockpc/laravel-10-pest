@extends('layouts.frontend.app')

@section('header', 'Home')

@section('content')
<div x-data="{ show: false }">
    <button x-on:click="show = !show">Show</button>
    <h1 x-show="show">Alpine Js is working !</h1>
</div>
@endsection
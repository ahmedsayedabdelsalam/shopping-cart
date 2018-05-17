@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    @include('partials.message')
    <h1 class="text-center">welcome to your Dashboard</h1>
    <a href="/item/create">Create Item</a>
@endsection
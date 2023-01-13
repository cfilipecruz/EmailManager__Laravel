@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')

@stop

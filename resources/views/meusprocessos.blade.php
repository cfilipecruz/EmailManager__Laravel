@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<!--{{ __('You are logged in!') }}-->

@extends('adminlte::page')

@section('title', 'Mail Manager')
@section('content')
<ul class="list-group">
  @foreach($processos as $processo)
    <li class="list-group-item list-group-item-primary">{{$processo->descricao}}</li>
    @endforeach
  </ul>
  @stop

@if( Auth::user()->nivelpermissao_id == 1)

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <!--{{ __('You are logged in!') }}-->

    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content')


    @stop

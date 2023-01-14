@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="container ">
        <div class="row pt-5">
            <div class="col-sm-4">
                <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Meus processos</h5>
                        <p class="card-text">Acessar e gerenciar meus processos.</p>
                        <a href="{{ route('meusprocessos') }}" class="btn btn-light">Ir para a pagina</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Mailbox</h5>
                        <p class="card-text">Gerenciar e-mails.</p>
                        <a href="{{ route('mailbox') }}" class="btn btn-light">Ir para a pagina</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Perfil</h5>
                        <p class="card-text">Visualizar o meu perfil.</p>
                        <a href="{{ route('perfil') }}" class="btn btn-light">Ir para a pagina</a>
                    </div>
                </div>
            </div>
            @if( Auth::user()->nivelpermissao_id == 1)
            <div class="col-sm-4">
                <div class="card text-white bg-warning mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Gerir Funcionários</h5>
                        <p class="card-text">Gerenciar funcionários da empresa.</p>
                        <a href="{{ route('funcionarioslist') }}" class="btn btn-light">Ir para a pagina</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Gerir Departamentos</h5>
                        <p class="card-text">Gerenciar departamentos da empresa.</p>
                        <a href="{{ route('departamentoslist') }}" class="btn btn-light">Ir para a pagina</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@stop

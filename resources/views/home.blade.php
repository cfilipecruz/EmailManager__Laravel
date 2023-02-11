@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2 class="font-weight-bold text-secondary">"O Mail Manager oferece uma solução otimizada e eficiente para
                gerir os seus e-mails e processos."</h2>
        </div>
    </div>
    <div class="container ">
        <div class="row pt-5">
            <div class="col-sm-4">
                <div class="card text-white bg-primary mb-3"
                     style="max-width: 20rem; animation: flipInX 1s ease-in-out;">
                    <div class="card-body">
                        <h5 class="card-title">Meus processos</h5>
                        <p class="card-text">Ver e gerir os meus processos.</p>
                        <a href="{{ route('meusprocessos') }}" class="btn btn-light">Ir para a página</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-success mb-3"
                     style="max-width: 20rem; animation: flipInX 1s ease-in-out;">
                    <div class="card-body">
                        <h5 class="card-title">Mailbox</h5>
                        <p class="card-text">Gerir e-mails.</p>
                        <a href="{{ route('mailbox') }}" class="btn btn-light">Ir para a página</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-white bg-danger mb-3"
                     style="max-width: 20rem; animation: flipInX 1s ease-in-out;">
                    <div class="card-body">
                        <h5 class="card-title">Perfil</h5>
                        <p class="card-text">Ver o meu perfil.</p>
                        <a href="{{ route('perfil') }}" class="btn btn-light">Ir para a página</a>
                    </div>
                </div>
            </div>
            @if( Auth::user()->nivelpermissao_id == 1)
                <div class="col-sm-4">
                    <div class="card text-white bg-warning mb-3"
                         style="max-width: 20rem; animation: flipInX 1s ease-in-out;">
                        <div class="card-body">
                            <h5 class="card-title">Funcionários</h5>
                            <p class="card-text">Gerir funcionários da empresa.</p>
                            <a href="{{ route('funcionarioslist') }}" class="btn btn-light">Ir para a página</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-white bg-info mb-3"
                         style="max-width: 20rem; animation: flipInX 1s ease-in-out;">
                        <div class="card-body">
                            <h5 class="card-title">Departamentos</h5>
                            <p class="card-text">Gerir departamentos da empresa.</p>
                            <a href="{{ route('departamentoslist') }}" class="btn btn-light">Ir para a página</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-white bg-secondary mb-3"
                         style="max-width: 20rem; animation: flipInX 1s ease-in-out;">
                        <div class="card-body">
                            <h5 class="card-title">Arquivos</h5>
                            <p class="card-text">Ver processos arquivados.</p>
                            <a href="{{ route('arquivo') }}" class="btn btn-light">Ir para a página</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header text-center bg-dark text-white">
                            <h5 class="card-title">Informações do Aluno</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Nome: </strong> {{ "Carlos Cruz" }}</p>
                            <p class="card-text"><strong>Número: </strong> {{ "20016" }}</p>
                            <p class="card-text"><strong>Email: </strong> {{ "carloscz@gmail.com" }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header text-center bg-dark text-white">
                            <h5 class="card-title">Informações do Cliente</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Nome: </strong> {{ "FTKODE" }}</p>
                            <p class="card-text"><strong>Localização: </strong> {{ "Viana do Castelo " }}</p>
                            <p class="card-text"><strong>Proponente: </strong> {{ "Miguel Guerra" }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header text-center bg-dark text-white">
                            <h5 class="card-title">Informações do Orientador</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Nome: </strong> {{ "José Viana" }}</p>
                            <p class="card-text"><strong>Email: </strong> {{ "josev@estg.ipvc.pt" }}</p>
                            <p class="card-text"><strong>Cargo: </strong> {{ "Professor Adjunto Convidado" }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <div class="card">
                        <div class="card-header text-center bg-dark text-white">
                            <h5 class="card-title">Informações do Projeto</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Nome: </strong> {{ "Mail Manager" }}</p>
                            <p class="card-text">
                                <strong>Escola: </strong> {{ "Escola Superior de tecnologia e Gestão" }}</p>
                            <p class="card-text">
                                <strong>Instituto: </strong> {{ "Intituto Politécnico de Viana do Castelo" }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop




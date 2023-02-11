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

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Departamento</th>
            </tr>
            </thead>
            <tbody>
            @foreach($arquivos as $arquivo)
                <tr class="list-group-item-action bg-primary">
                    <th scope="row">{{$arquivo->id}}</th>
                    <td>{{$arquivo->nome}}</td>
                    <td>{{optional($arquivo->departamento)->nome}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @stop
@endif

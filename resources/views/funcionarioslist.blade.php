@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<!--{{ __('You are logged in!') }}-->

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row m-1 mt-3">
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#criarFuncionario">
                Novo Funcionário
            </button>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Departamentos</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a style="cursor: pointer;" id="NewEmails" class="nav-link">
                                <i class="far fa-envelope"></i> Direção
                                <span class="badge bg-primary float-right">
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-9">
            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Procurar Funcionario">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
            <div id='funcionarios'>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
            integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script>

        $("#refreshEmails").on('click', function () {
            // $("#emails").empty()
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#emails").load("{!! route('admin.funcionarios') !!}")
        });

        $(document).on('click', 'a.verFuncionario', function (e) {
            var id = $(this).attr("data-id")
            // console.log(id);
            $("#funcionarios").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#funcionarios").load("{!! route('admin.funcionario') !!}" + "/" + id)
        });

        $("#funcionarios").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
        $("#funcionarios").load("{!! route('admin.funcionarios') !!}")

    </script>


    <div class="modal fade" id="criarFuncionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('funcionario.save')}}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Username:</label>
                            <input name="username" type="text" class="form-control" value="" id="recipient-name"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                                   placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Nome Completo:</label>
                            <input name="name" type="text" class="form-control" value="" id="recipient-name" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> E-mail:</label>
                            <input name="email" type="text" class="form-control" value="" id="message-text"
                                   required></input>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Nivel Permissão</label>
                            <select name="permissao" class="form-select" aria-label="Default select example" required>
                                @foreach($permissoes as $permissao)
                                    <option value="{{$permissao->id}}">{{$permissao->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Departamento</label>
                            <select name="departamento" class="form-select" aria-label="Default select example"
                                    required>
                                @foreach($departamentos as $departamento)
                                    <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Criar Funcionario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

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
        <div class="row m-1 mt-3">
            <div class="col-md-3">
                <a id="refreshEmails" class="btn btn-primary btn-block mb-3" data-toggle="modal"
                   data-target="#criarDepartamento">Novo Departamento </a>
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
                            <li class="nav-item">
                                <a style="cursor: pointer;" id="todos" class="nav-link">
                                    <i class=""></i> Possiveis Filtros
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div id='departamento'>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.2.min.js"
                integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

        <script>
            $(document).on('click', 'a.verDepartamento', function (e) {
                var id = $(this).attr("data-id")
                // console.log(id);
                $("#departamento").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
                $("#departamento").load("{!! route('admin.departamento') !!}" + "/" + id)
            });

            $("#departamento").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#departamento").load("{!! route('admin.departamentos') !!}")

        </script>

        <div class="modal fade" id="criarDepartamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Criar Departamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" method="post" action="{{route('departamento.save')}}">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">nome:</label>
                                <input autocomplete="false" name="nome" type="text" class="form-control" value=""
                                       id="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">identificador</label>
                                <input autocomplete="false" name="identificador" type="text" class="form-control"
                                       id="identificador" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Descricao:</label>
                                <textarea name="descricao" type="text" class="form-control" value=""
                                          id="descricao"
                                          required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Criar Departamento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop
@endif

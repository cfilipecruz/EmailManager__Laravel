<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5 class="my-3">Estado: {{$processo->estado_id}}</h5>
                <p class="text-muted mb-1">ID:{{$processo->id}}</p>
                <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#modalDelete">
                        Apagar
                    </button>
                    <button type="button" class="btn btn-info m-1" data-toggle="modal"
                            data-target="#modalUpdate">Atualizar
                    </button>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Nome</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$processo->nome}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Responsável</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$processo->funcionario_id}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Descrição</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$processo->descricao}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Departamento Atribuido</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$processo->departamento_id}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Criado em:</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{$processo->created_at}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('meusprocessos.delete', $processo->id)}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende Eliminar?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{$processo->id}}
                    {{$processo->nome}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Apagar Processo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar Processo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        action="{{route('meusprocessos.delete')}}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('meusprocessos.update', $processo->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Nome:</label>
                        <input name="nome" type="text" class="form-control" id="recipient-name"
                               value="{{$processo->nome}}"
                               placeholder="{{$processo->nome}}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Descrição: </label>
                        <textarea name="descricao" rows="8" class="form-control" id="message-text"
                                  value="{{$processo->descricao}}" placeholder="{{$processo->descricao}}"
                                  required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Funcionário</label>
                        <select name="funcionario" class="form-select" aria-label="Default select example" required>
                            @foreach($funcionarios as $funcionario)
                                <option value="{{$funcionario->id}}">{{$funcionario->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Departamento</label>
                        <select name="departamento" class="form-select" aria-label="Default select example" required>
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Estado</label>
                        <select name="estado" class="form-select" aria-label="Default select example" required>
                            @foreach($estados as $estado)
                                <option value="{{$estado->id}}">{{$estado->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

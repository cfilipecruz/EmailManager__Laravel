<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="card mb-4">
            <div class="card-body text-center">
                <h5 class="my-3">Estado: {{$processo->estado->nome}}</h5>
                <p class="text-muted mb-1">ID:{{$processo->id}}</p>
                <div class="d-flex justify-content-center mb-2">
                    @can('admin')
                        <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#modalArquivar">
                            Arquivar Processo
                        </button>
                    @endcan
                    <button type="button" class="btn btn-primary m-1" data-toggle="modal"
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
                        <p class="text-muted mb-0">{{ Auth::user()->username}}</p>
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
                        <p class="text-muted mb-0">{{$processo->departamento->nome}}</p>
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
<!--<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{route('meusprocessos.delete', $processo->id)}}">
            @csrf
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
                    </div>-->

<div class="modal fade" id="modalArquivar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{route('meusprocessos.arquivar', $processo->id)}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende arquivar o processo?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label"> Nome:</label>
                        <input name="nome" type="text" class="form-control" value="{{$processo->nome}}"
                               placeholder="Nome" id="nome"
                               required disabled>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"> Descrição:</label>
                        <textarea name="descricao" class="form-control" value="" id="descricao" required
                                  disabled>{{$processo->descricao}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Departamento</label>
                        <select name="departamento" id="department" class="custom-select form-control"
                                aria-label="Default select example" required disabled>
                            <option value="{{$processo->departamento_id}}"
                                    selected>{{$processo->departamento->nome}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Funcionário</label>
                        <select name="funcionario" id="employee" class="custom-select form-control"
                                aria-label="Default select example" required disabled>
                            <option value="{{ Auth::user()->id}}">{{ Auth::user()->username}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Estado</label>
                        <select name="estado" class="form-control" aria-label="Default select example" required
                                disabled>
                            <option value="{{$processo->estado_id}}">{{$processo->estado->nome}}</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-info">Arquivar Processo</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar Processo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('meusprocessos.update', $processo->id)}}">
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
                                  placeholder="{{$processo->descricao}}" required>{{$processo->descricao}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Funcionário</label>
                        <select name="funcionario" class="form-control" aria-label="Default select example" required>
                            <option value="{{ Auth::user()->id}}" selected>{{ Auth::user()->username}}</option>
                            @foreach($funcionarios as $funcionario)
                                @if($funcionario->username != Auth::user()->username)
                                    <option value="{{$funcionario->id}}">{{$funcionario->username}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Departamento</label>
                        <select name="departamento" class="form-control" aria-label="Default select example" required>
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Estado</label>
                        <select name="estado" class="form-control" aria-label="Default select example" required>
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

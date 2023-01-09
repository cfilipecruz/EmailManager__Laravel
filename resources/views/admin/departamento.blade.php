<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nome</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$departamento->nome}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Identificador</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$departamento->identificador}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Descrição</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$departamento->descricao}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Criado em:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$departamento->created_at}}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="updateDepartamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="post" action="{{route('$departamento.update', $departamento->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nome</label>
                        <input name="nome" type="text" class="form-control" value="{{$departamento->nome}}"
                               id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Identificador</label>
                        <input name="identificador" type="text" class="form-control" value="{{$departamento->identificador}}"
                               id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> E-mail:</label>
                        <textarea name="descricao" type="text" class="form-control" value="{{$departamento->descricao}}"
                               id="message-text" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Fazer Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('departamento.delete', $departamento->id)}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende Eliminar?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>ID: {{$departamento->id}}</p>
                    <p> Nome:  {{$departamento->nome}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Apagar Funcionário</button>
                </div>
            </div>
        </form>
    </div>
</div>



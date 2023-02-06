@if( Auth::user()->nivelpermissao_id == 1)

    <section style="background-color: #f4f5f7;">
        <div class="container py-5">
            <div class="row justify-content-center align-items-center">
                <div class=" col-lg-12 mb-4 mb-lg-0">
                    <div class="card mb-2" style="border-radius: .5rem;">
                        <div class="col-md-12">
                            <div class="card-body p-4">
                                <h6>{{$departamento->nome}}</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Identificador</h6>
                                        <p class="text-muted">{{$departamento->identificador}}</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Criado a</h6>
                                        <p class="text-muted">{{$departamento->created_at}}</p>
                                    </div>
                                </div>
                                <h6>Descrição</h6>
                                <hr class="mt-0 mb-4">
                                <div class="pt-1">
                                    <div class="col-12 mb-3">
                                        <p class="text-muted">{{$departamento->descricao}}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="button" class="btn btn-danger m-1" data-toggle="modal"
                                            data-target="#modalDelete">
                                        Apagar
                                    </button>
                                    <button type="button" class="btn btn-primary m-1" data-toggle="modal"
                                            data-target="#updateDepartamento">
                                        Update
                                    </button>
                                </div>
                            </div>
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
                    <form method="post" action="{{route('departamento.update', $departamento->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome</label>
                            <input name="nome" type="text" class="form-control" value="{{$departamento->nome}}"
                                   id="recipient-name" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Identificador</label>
                            <input name="identificador" type="text" class="form-control"
                                   value="{{$departamento->identificador}}"
                                   id="recipient-name" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label"> Descrição</label>
                            <textarea name="descricao" type="text" class="form-control" value=""
                                      id="message-text" required>{{$departamento->descricao}}</textarea>
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

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{route('departamento.delete', $departamento->id)}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende Eliminar?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>ID: {{$departamento->id}}</p>
                        <p> Nome: {{$departamento->nome}}</p>
                    </div>
                    <div class="modal-footer">
                        @if ($departamento->users->count() > 0)
                            <p class="text-danger">Existem funcionários associados a este departamento, por isso não é possível excluí-lo.</p>
                        @else
                            <button type="submit" class="btn btn-danger">Apagar Departamento</button>
                        @endif
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif


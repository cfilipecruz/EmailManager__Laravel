<div class="container">
    <div class="card mb-3">
        <div class="card-body text-center">
            <h5 class="my-3">Estado: {{$processo->estado->nome}}</h5>
            <p class="text-muted mb-1">ID:{{$processo->id}}</p>
            <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#modalArquivar">
                    Arquivar
                </button>
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
                    <p class="text-muted mb-0">{{ date('d/m/Y H:i', strtotime($processo->created_at)) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="d-flex justify-content-between align-items-center">
     <h3 class="text-secondary">Informações Fornecidas pelo Cliente</h3>
 </div>-->


<div class="modal fade" id="modalArquivar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{route('meusprocessos.arquivar', $processo->id)}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende Eliminar?</h5>
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
                        <label class="col-form-label"> Nome:</label>
                        <input name="nome" type="text" class="form-control" value="" placeholder="Nome" id="nome"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label"> Descrição:</label>
                        <textarea name="descricao" class="form-control" value="" id="descricao"
                                  required>{{$processo->descricao}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Departamento</label>
                        <select name="departamento" id="departamento" class="custom-select form-control"
                                aria-label="Default select example" required>
                            <option value="" selected>Selecionar Departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Funcionário</label>
                        <select name="funcionario" id="employees" class="custom-select form-control"
                                aria-label="Default select example">
                            <option value="">Selecionar Funcionário</option>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#departamento').on('change', function () {
            let departmentId = $(this).val();
            $.ajax({
                url: "{{ route('processos.employees') }}",
                type: 'GET',
                data: {departamento_id: departmentId},
                success: function (data) {
                    let employeeSelect = $('#employees');
                    employeeSelect.empty();
                    employeeSelect.append('<option value="">Selecionar Funcionário</option>');
                    $.each(data, function (index, employees) {
                        employeeSelect.append('<option value="' + employees.id + '">' + employees.username + '</option>');
                    });
                }
            });
        });
    });
</script>



<section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                             alt="avatar"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{$funcionario->username}}</h5>
                        <p class="text-muted mb-1">ID: {{$funcionario->id}}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#modalDelete">
                                Apagar
                            </button>
                            <button type="button" class="btn btn-info m-1" data-toggle="modal"
                                    data-target="#updateFuncionario">
                                Atualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nome Completo</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$funcionario->name}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$funcionario->email}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nivel de Permissão</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{optional($funcionario->nivelpermissao)->nome}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Departamento</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{optional($funcionario->departamento)->nome}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Criado em:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ date('d/m/Y H:i', strtotime($funcionario->created_at)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="updateFuncionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atualizar funcionario {{$funcionario->username}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('funcionario.update', $funcionario->id)}}">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Username:</label>
                        <input name="username" type="text" class="form-control" value="{{$funcionario->username}}"
                               id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input autocomplete="false" name="password" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Password" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> Nome Completo:</label>
                        <input name="name" type="text" class="form-control" value="{{$funcionario->name}}"
                               id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"> E-mail:</label>
                        <input name="email" type="text" class="form-control" value="{{$funcionario->email}}"
                               id="message-text" required>
                    </div>
                    <div class="form-group">
                        <label for="permissao" class="col-form-label">Nivel Permissão</label>
                        <select name="permissao" id="permissao" class="form-control">
                            @foreach($permissoes as $permissao)
                                <option value="{{$permissao->id}}">{{$permissao->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departamento" class="col-form-label">Departamento</label>
                        <select name="departamento" id="departamento" class="form-control">
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-info">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('funcionario.delete', $funcionario->id)}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Tem a certeza que pretende Eliminar?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>ID: {{$funcionario->id}}</p>
                    <p>Username: {{$funcionario->username}}</p>
                </div>
                <div class="modal-footer">
                    @if ($funcionario->processos->count() > 0)
                        <p class="text-danger mb-0">Existem processos associados a este funcionário, por isso não é possível excluí-lo.</p>
                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-dismiss="modal" data-target="#modalSafeDelete">
                            Apagar mesmo assim
                        </button>
                    @else
                        <button type="submit" class="btn btn-danger">Apagar Funcionário</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modalSafeDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{route('funcionario.safedelete', $funcionario->id)}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Atribuir processos a outro funcionario:</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Para eliminar este funcionário, terá que atribuir todos os processos do mesmo a um outro nesta lista:</p>
                    <p class="font-weight-bold">Funcionário atual:</p>
                    <p class="mb-1">ID: {{$funcionario->id}}</p>
                    <p class="mb-3">Username: {{$funcionario->username}}</p>
                    <p class="font-weight-bold">Funcionário a atribuir:</p>
                    <div class="form-group">
                        <label >Departamento</label>
                        <select name="departamento" id="departamentos" class="custom-select form-control"
                                aria-label="Default select example" required>
                            <option value="" selected>Selecionar Departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Funcionário</label>
                        <select name="funcionario" id="employee" class="custom-select form-control"
                                aria-label="Default select example" required>
                            <option value="">Selecionar Funcionário</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Atribuir e Apagar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#departamentos').on('change', function () {
            let departmentId = $(this).val();
            $.ajax({
                url: "{{ route('funcionario.employees') }}",
                type: 'GET',
                data: {departamento_id: departmentId},
                success: function (data) {
                    let employeeSelect = $('#employee');
                    employeeSelect.empty();
                    employeeSelect.append('<option value="">Selecionar Funcionário</option>');
                    $.each(data, function (index, employee) {
                        employeeSelect.append('<option value="' + employee.id + '">' + employee.username + '</option>');
                    });
                }
            });
        });
    });
</script>


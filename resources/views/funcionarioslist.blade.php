@if( Auth::user()->nivelpermissao_id == 1)

    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content')
        <div class="row p-3">
            <div class="col-md-3">
                <a id="refreshEmails" class="btn btn-primary btn-block mb-3" data-toggle="modal"
                   data-target="#criarFuncionario">Novo Funcionario </a>
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
                                    <i class=""></i> Todos
                                </a>
                            </li>
                            @foreach($departamentos as $departamento)
                                <li class="nav-item">
                                    <a style="cursor: pointer;" id="{{$departamento->id}}" class="nav-link">
                                        <i class=""></i> {{$departamento->nome}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="box-tools pull-right">
                    <div class="has-feedback">
                        <input type="text" name="search" class="form-control input-sm" id="search" value=""
                               placeholder="Procurar Funcionário pelo nome">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="text-secondary">Lista de Funcionários na Empresa</h3>
                </div>
                <div id='funcionarios'>
                </div>
            </div>
        </div>

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <style>
            .loading {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                position: relative;
            }

            .curve {
                border-radius: 50% 50% 0 50%;
                border: 10px solid #f4f6f9;
                animation: spin 2.5s ease-in-out infinite;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(0deg);
            }

            .yellow {
                border-top-color: #f1c40f;
                width: 80px;
                height: 80px;
                animation-delay: 0s;
            }

            .blue {
                border-top-color: #3498db;
                width: 100px;
                height: 100px;
                animation-delay: 0.2s;
            }

            .green {
                border-top-color: #2ecc71;
                width: 120px;
                height: 120px;
                animation-delay: 0.6s;
            }

            .red {
                border-top-color: #e74c3c;
                width: 140px;
                height: 140px;
                animation-delay: 0.8s;
            }

            .orange {
                border-top-color: #ff9f43;
                width: 160px;
                height: 160px;
                animation-delay: 1s;
            }

            .purple {
                border-top-color: #9b59b6;
                width: 90px;
                height: 90px;
                animation-delay: 1s;
            }

            .pink {
                border-top-color: #ff69b4;
                width: 70px;
                height: 70px;
                animation-delay: 1.2s;
            }

            .brown {
                border-top-color: #8b4513;
                width: 110px;
                height: 110px;
                animation-delay: 1.4s;
            }

            @keyframes spin {
                from {
                    transform: translate(-50%, -50%) rotate(0deg);
                }
                to {
                    transform: translate(-50%, -50%) rotate(360deg);
                }
            }
        </style>
        <script>

            var isEmailOpen = 1

            @foreach($departamentos as $departamento)
            $("#{{$departamento->id}}").on('click', function () {

                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                $("#funcionarios").load("{!! route('admin.funcionarios.filtro') !!}/{!! $departamento->identificador !!}")
                isEmailOpen = 0
            });
            @endforeach

            $("#todos").on('click', function () {
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                $("#funcionarios").load("{!! route('admin.funcionarios')!!}")
                isEmailOpen = 1
            });

            $(document).on('click', 'a.verFuncionario', function (e) {
                var id = $(this).attr("data-id")
                // console.log(id);
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                $("#funcionarios").load("{!! route('admin.funcionario') !!}" + "/" + id)
                isEmailOpen = 0
            });

            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#funcionarios").load("{!! route('admin.funcionarios') !!}")

            $("#search").on("keyup", function (e) {
                isEmailOpen = 0
                var val = $.trim(this.value);
                if (e.key === 'Backspace') {
                    console.log(val)
                    $("#funcionarios").load("{!! route('admin.funcionariosSearch') !!}/" + val)
                }
                $("#funcionarios").load("{!! route('admin.funcionariosSearch') !!}/" + val)
            });

            $(document).ready(function () {
                setInterval(function () {
                    if (isEmailOpen == 1) {
                        $("#emails").load("{!! route('mailbox.emails') !!}");
                    }
                }, 50000); // 1 minute
            });

            $(document).ready(function () {
                $("#todos").addClass("active");

                $(".nav-link").click(function () {
                    $(".nav-link").removeClass("active");
                    $(this).addClass("active");
                    var id = $(this).attr("id");
                    //Do other things you need based on the id of the selected item
                });
            });
        </script>

        <div class="modal fade" id="criarFuncionario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Criar Funcionário</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" method="post" action="{{route('funcionario.save')}}">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Username:</label>
                                <input autocomplete="false" name="username" type="text" class="form-control" value=""
                                       id="username"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input autocomplete="false" name="password" type="password" class="form-control"
                                       id="password"
                                       placeholder="Password" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Nome Completo:</label>
                                <input name="name" type="text" class="form-control" value="" id="nomecompleto"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> E-mail:</label>
                                <input name="email" type="email" class="form-control" value="" id="email"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="permissao" class="col-form-label font-weight-bold">Nível de
                                    Permissão</label>
                                <select name="permissao" id="permissao" class="form-control" required>
                                    @foreach($permissoes as $permissao)
                                        <option value="{{$permissao->id}}">{{$permissao->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="departamento" class="col-form-label font-weight-bold">Departamento</label>
                                <select name="departamento" id="departamento" class="form-control" required>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Criar Funcionario</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop
@endif

<script>
    document.querySelectorAll('.nav-link').forEach(function (element) {
        element.addEventListener('click', function () {
            document.querySelectorAll('.nav-link').forEach(function (e) {
                e.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
</script>

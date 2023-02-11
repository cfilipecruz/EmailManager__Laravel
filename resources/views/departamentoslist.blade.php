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
        <div class="row p-3">
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
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="text-secondary">Lista de Departamentos Implementados</h3>
                </div>
                <div id='departamento'>
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
            $(document).on('click', 'a.verDepartamento', function (e) {
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
                $("#departamento").load("{!! route('admin.departamento') !!}" + "/" + id)
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
                                <label for="recipient-name" class="col-form-label"> Descrição:</label>
                                <textarea name="descricao" type="text" class="form-control" value=""
                                          id="descricao"
                                          required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Criar Departamento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @stop
@endif

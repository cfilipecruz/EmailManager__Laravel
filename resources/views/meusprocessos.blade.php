@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<!--{{ __('You are logged in!') }}-->

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <div class="row p-3">
        <div class="col-md-3 ">
            <a id="refreshProcessos" class="btn btn-primary btn-block mb-3">Atualizar Processos</a>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pastas</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item ">
                            <a style="cursor: pointer;" id="processostodos" class="nav-link text-secondary">
                                <i class="fas fa-archive"></i> Todos
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a style="cursor: pointer;" id="processosConfirmados" class="nav-link text-primary">
                                <i class="fas fa-inbox"></i> Confirmados
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" id="processosProcessados" class="nav-link text-info">
                                <i class="fas fa-clipboard-check"></i> Processados
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a style="cursor: pointer;" id="processosAnulados" class="nav-link text-danger">
                                <i class="fas fa-ban"></i> Anulados
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a style="cursor: pointer;" id="processosConcluidos" class="nav-link text-success">
                                <i class="fas fa-check"></i> Concluidos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input type="text" name="search" class="form-control input-sm" id="search" value=""
                           placeholder="Procurar Processo pelo nome">
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-secondary">A Minha lista de Processos</h3>
            </div>
            <div id='processos'>
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

        $("#refreshProcessos").on('click', function () {
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processos') !!}")
            isEmailOpen = 1
        });

        $("#processostodos").on('click', function () {
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processos') !!}")
            isEmailOpen = 1
        });

        $("#processosConfirmados").on('click', function () {
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processosConfirmados') !!}")
            isEmailOpen = 0
        });

        $("#processosProcessados").on('click', function () {
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processosProcessados') !!}")
            isEmailOpen = 0
        });

        $("#processosAnulados").on('click', function () {
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processosAnulados') !!}")
            isEmailOpen = 0
        });

        $("#processosConcluidos").on('click', function () {
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processosConcluidos') !!}")
            isEmailOpen = 0
        });

        $(document).on('click', 'a.readProcesso', function (e) {
            var id = $(this).attr("data-id")
            //console.log(id);
            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#processos").load("{!! route('meusprocessos.processo') !!}" + "/" + id)
            isEmailOpen = 0
        });

        $("#search").on("keyup", function (e) {
            isEmailOpen = 0
            var val = $.trim(this.value);
            if (e.key === 'Backspace') {
                $("#processos").load("{!! route('meusprocessos.processosSearch') !!}/" + val)
            }
            $("#processos").load("{!! route('meusprocessos.processosSearch') !!}/" + val)
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
        $("#processos").load("{!! route('meusprocessos.processos') !!}")

        $(document).ready(function () {
            setInterval(function () {
                if (isEmailOpen == 1) {
                    $("#emails").load("{!! route('mailbox.emails') !!}");
                }
            }, 50000); // 5 minute
        });

        $(document).ready(function () {
            $("#processostodos").addClass("active bg-secondary");

            $(".nav-link").click(function () {
                $(".nav-link").removeClass("active bg-secondary bg-danger bg-primary bg-info bg-success");
                var id = $(this).attr("id");
                switch (id) {
                    case 'processostodos':
                        $(this).addClass("active bg-secondary");
                        break;
                    case 'processosConfirmados':
                        $(this).addClass("active bg-primary");
                        break;
                    case 'processosProcessados':
                        $(this).addClass("active bg-info");
                        break;
                    case 'processosAnulados':
                        $(this).addClass("active bg-danger");
                        break;
                    case 'processosConcluidos':
                        $(this).addClass("active bg-success");
                        break;
                }
            });
        });
    </script>
@stop




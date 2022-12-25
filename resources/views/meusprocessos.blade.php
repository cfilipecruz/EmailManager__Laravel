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
    <div class="row m-1 mt-3">
        <div class="col-md-3">
            <a id="refreshProcessos" class="btn btn-primary btn-block mb-3">Refresh Emails</a>
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
                        <li class="nav-item active bg-primary">
                            <a  style="cursor: pointer;" id="processosConfirmados" class="nav-link">
                                <i class="fas fa-inbox"></i> Confirmados
                            </a>
                        </li>
                        <li class="nav-item bg-info">
                            <a  style="cursor: pointer;"  id="processosProcessados" class="nav-link">
                                <i  class="fas fa-clipboard-check"></i> Processados
                            </a>
                        </li>
                        <li class="nav-item  bg-secondary">
                            <a  style="cursor: pointer;"  id="processosAbertos" class="nav-link">
                                <i class="fas fa-folder-open"></i> Abertos
                            </a>
                        </li>
                        <li class="nav-item  bg-danger">
                            <a  style="cursor: pointer;"  id="processosAnulados" class="nav-link">
                                <i  class="fas fa-ban"></i> Anulados
                            </a>
                        </li>
                        <li class="nav-item  bg-success">
                            <a  style="cursor: pointer;"  id="processosConcluidos" class="nav-link">
                                <i  class="fas fa-check"></i> Concluidos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- <div class="card">
                 <div class="card-header">
                     <h3 class="card-title">Labels</h3>
                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse">
                             <i class="fas fa-minus"></i>
                         </button>
                     </div>
                 </div>
                 <div class="card-body p-0">
                     <ul class="nav nav-pills flex-column">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle text-danger"></i>
                                 Important
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle text-warning"></i> Promotions
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle text-primary"></i>
                                 Social
                             </a>
                         </li>
                     </ul>
                 </div>
             </div>-->
        </div>
        <div class="col-md-9 mb-5">
            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input type="text" class="form-control input-sm" placeholder="Procurar Processo pelo nome">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
            <div id='processos'>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
            integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script>

        $("#refreshProcessos").on('click', function () {
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processos') !!}")
        });

        $("#processosConfirmados").on('click', function () {
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processosConfirmados') !!}")
        });

        $("#processosProcessados").on('click', function () {
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processosProcessados') !!}")
        });

        $("#processosAbertos").on('click', function () {
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processosAbertos') !!}")
        });

        $("#processosAnulados").on('click', function () {
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processosAnulados') !!}")
        });

        $("#processosConcluidos").on('click', function () {
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processosConcluidos') !!}")
        });

        $(document).on('click', 'a.readProcesso', function (e) {
            var id = $(this).attr("data-id")
            //console.log(id);
            $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#processos").load("{!! route('meusprocessos.processo') !!}" + "/" + id)
        });

        $("#processos").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
        $("#processos").load("{!! route('meusprocessos.processos') !!}")


    </script>

@stop




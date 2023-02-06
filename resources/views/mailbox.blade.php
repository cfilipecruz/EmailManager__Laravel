@if( Auth::user()->departamento_id <= 2)
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row m-1 mt-3">
        <div class="col-md-3">
            <a id="refreshEmails" class="btn btn-primary btn-block mb-3">Atualizar Emails</a>
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
                        <li class="nav-item active">
                            <a style="cursor: pointer;" id="allEmails" class="nav-link">
                                <i class="far fa-folder"></i> Todos
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a style="cursor: pointer;" id="NewEmails" class="nav-link">
                                <i class="far fa-envelope"></i> Novos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" id="seenEmails" class="nav-link">
                                <i class="far fa-envelope-open"></i> Lidos
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box-tools pull-right">
                <div class="has-feedback">
                   <!-- <input type="text" name=text autocomplete="off" class="form-control input-sm" id="search"
                           value="" placeholder="Procurar email">
                     <a type="submit" class="btn btn-primary" id="processosSearch">Procurar</a> -->
                </div>
            </div>
            <div id='emails'>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script>
        var isEmailOpen = 1;


        $("#refreshEmails").on('click', function () {
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            isEmailOpen = 1;
            $("#emails").load("{!! route('mailbox.emails') !!}")
        });

        $("#allEmails").on('click', function () {
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            isEmailOpen = 1;
            $("#emails").load("{!! route('mailbox.emails') !!}")
        });

        $("#NewEmails").on('click', function () {
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
             isEmailOpen = 2;
            $("#emails").load("{!! route('mailbox.emailsnew') !!}")
        });

        $("#seenEmails").on('click', function () {
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
             isEmailOpen = 0;
            $("#emails").load("{!! route('mailbox.emailsseen') !!}")
        });

        $(document).on('click', 'a.readEmail', function (e) {
            var id = $(this).attr("data-id")
            isEmailOpen = 0;
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#emails").load("{!! route('mailbox.email') !!}" + "/" + id)
        })

        $(document).on('click', 'a.changePage', function (e) {
            var href = $(this).attr("data-href")
             isEmailOpen = 0;
            console.log(href)
            $("#emails").load(href)
        })

        $(document).on('click', 'a.markasseen', function (e) {
            var id = $(this).attr("data-id")
            $("#emails").load("{!! route('mailbox.emails.asseen') !!}" + "/" + id)
        })

        $(document).on('click', 'a.markasnotseen', function (e) {
            var id = $(this).attr("data-id")
            $("#emails").load("{!! route('mailbox.emails.asnotseen') !!}" + "/" + id)
        })

        $("#search").on("keyup", function (e) {
             isEmailOpen = 0;
            var val = $.trim(this.value);
            if (e.key === 'Backspace') {
                $("#emails").load("{!! route('mailbox.emails.search') !!}/" + val)
            }
            $("#emails").load("{!! route('mailbox.emails.search') !!}/" + val)
        });

        $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
        $("#emails").load("{!! route('mailbox.emails') !!}")

        $(document).ready(function() {
            setInterval(function() {
                if (isEmailOpen==1) {
                    $("#emails").load("{!! route('mailbox.emails') !!}");
                }else if(isEmailOpen==2){
                    $("#emails").load("{!! route('mailbox.emailsnew') !!}");
                }
            }, 50000); // 1 minute
        });
    </script>

@stop
@endif

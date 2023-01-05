@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<!--{{ __('You are logged in!') }}-->

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="row m-1 mt-3">
        <div class="col-md-3">
            <a id="refreshEmails" class="btn btn-primary btn-block mb-3">Refresh Emails</a>
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
                            <a style="cursor: pointer;" id="NewEmails" class="nav-link">
                                <i class="far fa-envelope"></i> Novos
                                <span class="badge bg-primary float-right">
                                </span>
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
        <div class="col-md-9">
            <div class="box-tools pull-right">
                <div class="has-feedback">
                    <input id="#search" type="text" name="search" class="form-control input-sm"
                           placeholder="Search Mail">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
            <div id='emails'>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.2.min.js"
            integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script>

        $("#refreshEmails").on('click', function () {
            // $("#emails").empty()
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#emails").load("{!! route('mailbox.emails') !!}")
        });

        $("#NewEmails").on('click', function () {
            // $("#emails").empty()
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#emails").load("{!! route('mailbox.emailsnew') !!}")
        });

        $("#seenEmails").on('click', function () {
            // $("#emails").empty()
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#emails").load("{!! route('mailbox.emailsseen') !!}")
        });

        $(document).on('click', 'a.readEmail', function (e) {
            var id = $(this).attr("data-id")
            //console.log(id);
            $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
            $("#emails").load("{!! route('mailbox.email') !!}" + "/" + id)
        });

        $("#emails").html("<img src=' https://flevix.com/wp-content/uploads/2019/07/Curve-Loading.gif' >")
        $("#emails").load("{!! route('mailbox.emails') !!}")


    </script>

@stop

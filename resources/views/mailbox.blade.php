@if( Auth::user()->departamento_id <= 2)
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @extends('adminlte::page')

    @section('title', 'Dashboard')

    @section('content')
        <div class="row p-3">
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
                                    <i class="far fa-folder"></i> Caixa de Entrada
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
            var isEmailOpen = 1;

            $("#refreshEmails").on('click', function () {
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                isEmailOpen = 1;
                $("#emails").load("{!! route('mailbox.emails') !!}")
            });

            $("#allEmails").on('click', function () {
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                isEmailOpen = 1;
                $("#emails").load("{!! route('mailbox.emails') !!}")
            });

            $("#NewEmails").on('click', function () {
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                isEmailOpen = 2;
                $("#emails").load("{!! route('mailbox.emailsnew') !!}")
            });

            $("#seenEmails").on('click', function () {
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
                isEmailOpen = 0;
                $("#emails").load("{!! route('mailbox.emailsseen') !!}")
            });

            $(document).on('click', 'a.readEmail', function (e) {
                var id = $(this).attr("data-id")
                isEmailOpen = 0;
                $("#emails").html(
                    "<div class='loading'>" +
                    "<div class='curve blue'></div>" +
                    "<div class='curve yellow'></div>" +
                    "<div class='curve green'></div>" +
                    "<div class='curve red'></div>" +
                    "<div class='curve orange'></div>" +
                    "</div>"
                );
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

            $("#emails").html(
                "<div class='loading'>" +
                "<div class='curve blue'></div>" +
                "<div class='curve yellow'></div>" +
                "<div class='curve green'></div>" +
                "<div class='curve red'></div>" +
                "<div class='curve orange'></div>" +
                "</div>"
            );
            $("#emails").load("{!! route('mailbox.emails') !!}")

            $(document).ready(function () {
                setInterval(function () {
                    if (isEmailOpen == 1) {
                        $("#emails").load("{!! route('mailbox.emails') !!}");
                    } else if (isEmailOpen == 2) {
                        $("#emails").load("{!! route('mailbox.emailsnew') !!}");
                    }
                }, 50000); // 1 minute
            });

            $(document).ready(function () {
                $("#allEmails").addClass("active");

                $(".nav-link").click(function () {
                    $(".nav-link").removeClass("active");
                    $(this).addClass("active");
                    var id = $(this).attr("id");
                    //Do other things you need based on the id of the selected item
                });
            });

        </script>

    @stop
@endif

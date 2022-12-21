@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<!--{{ __('You are logged in!') }}-->

@extends('adminlte::page')

@section('title', 'Mail Manager')
@section('content')

<head>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     

     <link rel="icon" href="../domain.png">
   
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
        <script src="https://kit.fontawesome.com/ccf24ce75c.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/../css/bootstrap.min.css">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/tooplate-gymso-style.css">

</head>
<body data-spy="scroll" data-target="#navbarNav" data-offset="50">
<div id="preloader" style=""></div>

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                  <form id="formAccountSettings" method="POST" action="{{ route('perfil.update',auth()->id()) }}" enctype="multipart/form-data" class="needs-validation" role="form" novalidate>
                  @csrf
                  <img src="{{asset(Auth::user()->avatar)}}" style="height:160px; width:160px; border-radius:50%; margin-right:5px; border: 2px solid red; border-color: gray;" >
                    
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ Auth::user()->name }}</h4>
                    <p class="mb-0">{{ Auth::user()->email }}</p>
                    <div class="text-muted"><small>Última vez Online: {{ Auth::user()->updated_at->format('d/m/Y') }}</small></div>
                    <div class="mt-2">
                       <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#delete-user">Apagar Conta</button>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">Cliente</span>
                    <div class="text-muted"><small>Cliente desde {{ Auth::user()->created_at->format('d/m/Y') }}</small></div>
                    <button class="btn btn-block btn-danger mt-4" onclick="location.href='{{ route('logout') }}'">
                      <i class="fa fa-sign-out"></i>
                      <span>Sair</span>
                    </button>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Informações</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Nome</label>
                              <input class="form-control" type="text" name="name" placeholder="" value="{{ auth()->user()->name }}">
                            </div>
                          </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text" name="email" placeholder="" value="{{ auth()->user()->email }}">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Alterar Palavra-Passe</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Nova Palavra-Passe</label>
                              <input class="form-control" type="password" placeholder="" name="password" value="{{ auth()->user()->password }}">
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     <!-- SCRIPTS -->
     <script src="../js/jquery.min.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/aos.js"></script>
     <script src="../js/custom.js"></script>
     <script src="js/custom-file-input.js"></script>
     <script src="../js/custom.js"></script> 

</body>
</html>
@stop


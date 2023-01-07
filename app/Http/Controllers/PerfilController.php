<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use App\Models\User;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $funcionario = Auth::user();
        return view('perfil')->with(['funcionario'=>$funcionario]);
    }
}

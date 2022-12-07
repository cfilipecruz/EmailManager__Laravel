<?php

namespace App\Http\Controllers;

use App\Models\User;    
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        return view('perfil');
    }

    public function update(User $user, Request $request)
    {   
        return back();
    }
}

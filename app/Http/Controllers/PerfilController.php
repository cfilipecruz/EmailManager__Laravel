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
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'updated_at' => now()
         ]);

        return back();
    }
}

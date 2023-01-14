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

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current.password' => 'The current password is incorrect']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return back()->with('status', 'Password changed successfully');
    }
}

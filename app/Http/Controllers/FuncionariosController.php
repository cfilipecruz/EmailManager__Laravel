<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;

class FuncionariosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function funcionarioslist()
    {
        return view('funcionarioslist');
    }
    public function funcionarios(){

        $funcionarios = User::all();
        $departamentos = Departamento::all();

        return view('admin.funcionarios')->with(['funcionarios'=>$funcionarios,
                                                        'departamentos'=>$departamentos
                                                        ]);
    }
}

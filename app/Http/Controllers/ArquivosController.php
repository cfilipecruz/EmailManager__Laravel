<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Models\Departamento;
use App\Models\Processo;
use Illuminate\Http\Request;

class ArquivosController extends Controller
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
    public function arquivo()
    {
        $arquivos = Arquivo::all();

        return view('arquivo')->with(['arquivos' => $arquivos]);
    }
}

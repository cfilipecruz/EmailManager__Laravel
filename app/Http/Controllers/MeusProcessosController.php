<?php

namespace App\Http\Controllers;

use App\Models\Processo;
use Illuminate\Http\Request;

class MeusProcessosController extends Controller
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
    public function meusprocessos()
    {
        $processos = Processo::all();
      //  dd($processos);
        return view('meusprocessos') ->with(['processos'=>$processos]);
    }
}

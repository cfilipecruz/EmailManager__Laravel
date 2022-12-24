<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        return view('meusprocessos');
    }

    public function processos(){
        $processos = Processo::where('funcionario_id',\auth()->user()->id)->get();
        $departamentos = Departamento::all();
       // $processos =  Processo::all();
        //  dd($processos);
        return view('meusprocessos.processos') ->with(['processos'=>$processos,
                                                            'departamentos'=>$departamentos]);
    }

    public function meusprocessosSave(Request $request){
       // dd($request->all());

        $processo= new Processo();

        $processo->nome= $request->nome;
        $processo->descricao= $request->descricao;
        $processo->estado_id= 1;
        $processo->departamento_id= $request->departamento;
        $processo->funcionario_id= $request->funcionario;

        $processo->save();

        return redirect()->back();
    }

    public function processo($id){

        $processo = Processo::where($id);

        $funcionarios = User::all();
        $departamentos = Departamento::all();

        return view('mailbox.email')->with(['processo'=>$processo,
            'funcionarios'=>$funcionarios,
            'departamentos'=>$departamentos]);
    }
}

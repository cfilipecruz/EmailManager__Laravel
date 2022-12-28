<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Estado;
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
          //dd($processos);
        return view('meusprocessos.processos') ->with(['processos'=>$processos,
                                                            'departamentos'=>$departamentos]);
    }

    public function processosConfirmados(){
        $processos = Processo::where('funcionario_id',\auth()->user()->id)->get();
        $departamentos = Departamento::all();
        // $processos =  Processo::all();
        //  dd($processos);
        return view('meusprocessos.processosConfirmados') ->with(['processos'=>$processos,
            'departamentos'=>$departamentos]);
    }
    public function processosProcessados(){
        $processos = Processo::where('funcionario_id',\auth()->user()->id)->get();
        $departamentos = Departamento::all();
        // $processos =  Processo::all();
        //  dd($processos);
        return view('meusprocessos.processosProcessados') ->with(['processos'=>$processos,
            'departamentos'=>$departamentos]);
    }
    public function processosAbertos(){
        $processos = Processo::where('funcionario_id',\auth()->user()->id)->get();
        $departamentos = Departamento::all();
        // $processos =  Processo::all();
        //  dd($processos);
        return view('meusprocessos.processosAbertos') ->with(['processos'=>$processos,
            'departamentos'=>$departamentos]);
    }
    public function processosAnulados(){
        $processos = Processo::where('funcionario_id',\auth()->user()->id)->get();
        $departamentos = Departamento::all();
        // $processos =  Processo::all();
        //  dd($processos);
        return view('meusprocessos.processosAnulados') ->with(['processos'=>$processos,
            'departamentos'=>$departamentos]);
    }
    public function processosConcluidos(){
        $processos = Processo::where('funcionario_id',\auth()->user()->id)->get();
        $departamentos = Departamento::all();
        // $processos =  Processo::all();
        //  dd($processos);
        return view('meusprocessos.processosConcluidos') ->with(['processos'=>$processos,
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

        $processo = Processo::find($id);

        $funcionarios = User::all();
        $departamentos = Departamento::all();
        $estados = Estado::all();

        return view('meusprocessos.processo')->with(['processo'=>$processo,
            'funcionarios'=>$funcionarios,
            'estados'=>$estados,
            'departamentos'=>$departamentos]);
    }

    public function update(Request $request, $id)
    {
        $processo = Processo::find($id);
        $processo->nome= $request->nome;
        $processo->descricao= $request->descricao;
        $processo->funcionario_id= $request->funcionario;
        $processo->departamento_id= $request->departamento;
        $processo->estado_id= $request->estado;

        $processo->update();

        return redirect()->back();
    }
    public function delete($id){

        $processo = Processo::find($id);
        $processo->delete();

        return view('meusprocessos');
    }
}

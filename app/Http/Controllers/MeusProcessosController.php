<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Email;
use App\Models\Estado;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Arquivo;

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

    public function processos()
    {
        $processos = Processo::where('user_id', \auth()->user()->id)->orderBy('id', 'desc')->get();
        $departamentos = Departamento::all();
        return view('meusprocessos.processos')->with(['processos' => $processos,
            'departamentos' => $departamentos]);
    }

    public function processosConfirmados()
    {
        $processos = Processo::where('user_id', \auth()->user()->id)->orderBy('id', 'desc')->get();
        $departamentos = Departamento::all();
        return view('meusprocessos.processosConfirmados')->with(['processos' => $processos,
            'departamentos' => $departamentos]);
    }

    public function processosProcessados()
    {
        $processos = Processo::where('user_id', \auth()->user()->id)->orderBy('id', 'desc')->get();
        $departamentos = Departamento::all();
        return view('meusprocessos.processosProcessados')->with(['processos' => $processos,
            'departamentos' => $departamentos]);
    }

    public function processosAbertos()
    {
        $processos = Processo::where('user_id', \auth()->user()->id)->orderBy('id', 'desc')->get();
        $departamentos = Departamento::all();
        return view('meusprocessos.processosAbertos')->with(['processos' => $processos,
            'departamentos' => $departamentos]);
    }

    public function processosAnulados()
    {
        $processos = Processo::where('user_id', \auth()->user()->id)->orderBy('id', 'desc')->get();
        $departamentos = Departamento::all();
        return view('meusprocessos.processosAnulados')->with(['processos' => $processos,
            'departamentos' => $departamentos]);
    }

    public function processosConcluidos()
    {
        $processos = Processo::where('user_id', \auth()->user()->id)->orderBy('id', 'desc')->get();
        $departamentos = Departamento::all();
        return view('meusprocessos.processosConcluidos')->with(['processos' => $processos,
            'departamentos' => $departamentos]);
    }

    public function meusprocessosSave(Request $request)
    {
        $processo = new Processo();

        $processo->nome = $request->nome;
        $processo->descricao = $request->descricao;
        $processo->estado_id = 1;
        $processo->departamento_id = $request->departamento;
        $processo->user_id = $request->funcionario;

        $processo->save();

        $email = new Email();

         $email->assunto = $request->assunto;
         $email->emailremetente = $request->emailremetente;
         $email->desenvolvimento = $request->desenvolvimento;

         $email->processo_id = $processo->id;

         $email->save();

        return redirect()->back();
    }

    public function processo($id)
    {
        $processo = Processo::find($id);

        $funcionarios = User::all();
        $departamentos = Departamento::all();
        $estados = Estado::all();
       // $email = Email::where('processo_id', $id);

        return view('meusprocessos.processo')->with(['processo' => $processo,
           // 'email' => $email,
            'funcionarios' => $funcionarios,
            'estados' => $estados,
            'departamentos' => $departamentos
        ]);
    }

    public function update(Request $request, $id)
    {
        $processo = Processo::find($id);
        $processo->nome = $request->nome;
        $processo->descricao = $request->descricao;
        $processo->user_id = $request->funcionario;
        $processo->departamento_id = $request->departamento;
        $processo->estado_id = $request->estado;

        $processo->update();

        return redirect()->back();
    }

    public function delete($id)
    {
        $processo = Processo::find($id);
        $processo->delete();

        return redirect()->back();
    }

    public function processosSearch($search = null)
    {
        $departamentos = Departamento::all();

        if($search == null){
            $processos = Processo::all();
        }else{
            $processos = Processo::where('nome', 'like', '%' . $search . '%')
                ->where('user_id', \auth()->user()->id)
                ->get();
        }

        return view('meusprocessos.processosSearch')->with(['processos' => $processos,
            'departamentos' => $departamentos
        ]);
    }
    public function arquivar($id)
    {

        $processo = Processo::find($id);

        $arquivo = new Arquivo();

        $arquivo->nome = $processo->nome;
        $arquivo->descricao = $processo->descricao;
        $arquivo->estado_id = $processo->estado_id;
        $arquivo->departamento_id = $processo->departamento_id;
        $arquivo->user_id = $processo->user_id;
        $arquivo->created_at =\Carbon\Carbon::now();

        $arquivo->save();

        $processo->delete();

        return redirect()->back();
    }

    public function employees(Request $request)
    {
        $employees = User::where('departamento_id', $request->departamento_id)->get();
        return response()->json($employees);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Nivelpermissao;
use App\Models\Processo;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Uid\AbstractUid;

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
        $departamentos = Departamento::all();
        $permissoes = Nivelpermissao::all();

        return view('funcionarioslist')->with(['permissoes' => $permissoes,
            'departamentos' => $departamentos
        ]);
    }

    public function funcionarios()
    {
        $funcionarios = User::has('Departamento')->with(['Departamento'])->get();
        $departamentos = Departamento::all();

        return view('admin.funcionarios')->with(['funcionarios' => $funcionarios,
            'departamentos' => $departamentos
        ]);
    }

    public function funcionario($id)
    {
        $processo = Processo::all();
        $funcionario = User::find($id);
        $funcionarios = User::all();
        $departamentos = Departamento::all();
        $permissoes = Nivelpermissao::all();

        return view('admin.funcionario')->with(['processo' => $processo,
            'funcionarios' => $funcionarios,
            'funcionario' => $funcionario,
            'permissoes' => $permissoes,
            'departamentos' => $departamentos
        ]);
    }

    public function update(Request $request, $id)
    {

        $funcionario = User::find($id);
        $funcionario->username = $request->username;
        $funcionario->password = bcrypt($request->password);
        $funcionario->name = $request->name;
        $funcionario->email = $request->email;
        $funcionario->departamento_id = $request->departamento;
        $funcionario->nivelpermissao_id = $request->permissao;

        $funcionario->update();

        return redirect()->back();
    }

    public function delete($id)
    {

        $funcionario = User::find($id);

        $funcionario->delete();

        return redirect()->back();
    }

    public function save(Request $request)
    {
        // dd($request->all());

        $funcionario = new User();

        $funcionario->username = $request->username;
        $funcionario->name = $request->name;
        $funcionario->email = $request->email;
        $funcionario->departamento_id = $request->departamento;
        $funcionario->nivelpermissao_id = $request->permissao;
        $funcionario->password = bcrypt($request->password);

        $funcionario->save();

        return redirect()->back();
    }

    public function filtro($search)
    {
        $funcionarios = Departamento::where('identificador', $search)->first()->users;

        // dd($funcionarios);
        return view('admin.funcionariosSearch')->with(['funcionarios' => $funcionarios]);
    }

    public function funcionariosSearch($search = '')
    {
        $departamentos = Departamento::all();

        if ($search == '') {
            $funcionarios = User::all();
        } else {
            $funcionarios = User::where('username', 'like', '%' . $search . '%')->get();
        }

        return view('admin.funcionariosSearch')->with(['funcionarios' => $funcionarios ?? 'N/A',
            'departamentos' => $departamentos
        ]);
    }
    public function safedelete($id)
    {
        $funcionario = User::find($id);
        $processos = $funcionario->processos;

        // Get a list of all other funcionarios
        $otherFuncionarios = User::where('id', '!=', $id)->get();

        // If there are other funcionarios available to transfer processos to
        if (count($otherFuncionarios) > 0) {
            // Choose the first funcionario from the list
            $newFuncionario = $otherFuncionarios[0];

            // Transfer the processos to the new funcionario
            foreach ($processos as $processo) {
                $processo->user_id = $newFuncionario->id;
                $processo->save();
            }

            // Delete the original funcionario
            $funcionario->delete();

            return redirect()->back()
                ->with('success', 'Funcionário apagado e seus processos transferidos com sucesso.');
        } else {
            return redirect()->route('funcionarios.index')
                ->with('error', 'Não há outro funcionário disponível para transferir os processos.');
        }
    }
    public function employees(Request $request)
    {
        $employees = User::where('departamento_id', $request->departamento_id)->get();
        return response()->json($employees);
    }
}



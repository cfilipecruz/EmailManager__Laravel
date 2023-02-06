<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
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

    public function departamentoslist()
    {
        $departamentos = Departamento::all();

        return view('departamentoslist')->with(['departamentos' => $departamentos]);
    }

    public function departamentos()
    {
        $departamentos = Departamento::all();

        return view('admin.departamentos')->with(['departamentos' => $departamentos]);
    }

    public function departamento($id)
    {
        $departamento = Departamento::find($id);

        return view('admin.departamento')->with(['departamento' => $departamento]);
    }

    public function update(Request $request, $id)
    {

        $departamento = Departamento::find($id);

        $departamento->nome = $request->nome;
        $departamento->identificador = $request->identificador;
        $departamento->descricao = $request->descricao;

        $departamento->update();

        return redirect()->back();
    }

    public function delete($id)
    {
        $departamento = Departamento::find($id);

        if ($departamento->users->count() > 0) {
            // If there are funcionarios associated with the departamento, return a message to the user
            return redirect()->back()->withErrors(['error' => 'Existem funcionários associados a este departamento, por isso não é possível excluí-lo.']);
        }

        $departamento->delete();

        return redirect()->back()->with('Sucesso', 'Departamento apago com sucesso.');
    }

    public function save(Request $request)
    {
        // dd($request->all());

        $departamento = new Departamento();

        $departamento->nome = $request->nome;
        $departamento->identificador = $request->identificador;
        $departamento->descricao = $request->descricao;

        $departamento->save();

        return redirect()->back();
    }
}

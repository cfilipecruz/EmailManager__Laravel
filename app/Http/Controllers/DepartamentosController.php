<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\User;
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

        $departamento = new Departamento();

        $departamento->nome = $request->nome;
        $departamento->identificador = $request->identificador;
        $departamento->descricao = $request->descricao;

        $departamento->update();

        return redirect()->back();
    }

    public function delete($id)
    {

        $departamento = User::find($id);

        $departamento->delete();

        return redirect()->back();
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

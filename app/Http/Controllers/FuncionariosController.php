<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Nivelpermissao;
use App\Models\Processo;
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
        $departamentos = Departamento::all();
        $permissoes = Nivelpermissao::all();

        return view('funcionarioslist')->with(['permissoes'=>$permissoes,
            'departamentos'=>$departamentos
        ]);
    }
    public function funcionarios(){

        $funcionarios = User::all();
        $departamentos = Departamento::all();

        return view('admin.funcionarios')->with(['funcionarios'=>$funcionarios,
                                                        'departamentos'=>$departamentos
                                                        ]);
    }

    public function funcionario($id){

        $processo = Processo::all();
        $funcionario = User::find($id);
        $funcionarios = User::all();
        $departamentos = Departamento::all();
        $permissoes = Nivelpermissao::all();

        return view('admin.funcionario')->with(['processo'=>$processo,
            'funcionarios'=>$funcionarios,
            'funcionario'=>$funcionario,
            'permissoes'=>$permissoes,
            'departamentos'=>$departamentos
        ]);
    }

    public function update(Request $request, $id){

        $funcionario = User::find($id);
        $funcionario->username= $request->username;
        $funcionario->name= $request->name;
        $funcionario->email= $request->email;
        $funcionario->departamento_id= $request->departamento;
        $funcionario->nivelpermissao_id= $request->permissao;

        $funcionario->update();

        return redirect()->back();
    }

    public function delete($id){

        $funcionario = User::find($id);

        $funcionario->delete();

        return redirect()->back();
    }

    public function save(Request $request){
        // dd($request->all());

        $funcionario= new User();

        $funcionario->username= $request->username;
        $funcionario->name= $request->name;
        $funcionario->email= $request->email;
        $funcionario->departamento_id= $request->departamento;
        $funcionario->nivelpermissao_id= $request->permissao;
        $funcionario->password= $request->password;

        $funcionario->save();

        return redirect()->back();
    }
}

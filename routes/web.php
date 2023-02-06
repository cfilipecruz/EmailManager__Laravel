<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerfilController;
use App\Http\Controllers\MeusProcessosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return view('auth.login');
});

Auth::routes();

//Verificiar que utilizador tem login----------------

//Home Page
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Mailbox-------------------------------------------------------
Route::get('/mailbox', [App\Http\Controllers\MailBoxController::class, 'mailbox'])->name('mailbox');

Route::get('/mailbox/emails', [App\Http\Controllers\MailBoxController::class, 'emails'])->name('mailbox.emails');

Route::get('/mailbox/emails/asssen/{id?}', [App\Http\Controllers\MailBoxController::class, 'emailsasseen'])->name('mailbox.emails.asseen');

Route::get('/mailbox/emails/asnotseen/{id?}', [App\Http\Controllers\MailBoxController::class, 'emailsasnotseen'])->name('mailbox.emails.asnotseen');

Route::get('/mailbox/emailsnew', [App\Http\Controllers\MailBoxController::class, 'emailsnew'])->name('mailbox.emailsnew');

Route::get('/mailbox/emailsseen', [App\Http\Controllers\MailBoxController::class, 'emailsseen'])->name('mailbox.emailsseen');

Route::get('/mailbox/emails/Search/{search?}', [App\Http\Controllers\MailBoxController::class, 'emailsSearch'])->name('mailbox.emails.search');

Route::get('/mailbox/email/{id?}', [App\Http\Controllers\MailBoxController::class, 'email'])->name('mailbox.email');

Route::post('/attachment/open', [App\Http\Controllers\MailBoxController::class, 'openAttachment'])->name('attachment.open');

Route::get('/attachment/employees', [App\Http\Controllers\MailBoxController::class, 'employees'])->name('employees');


//Processos---------------------------------------------------------------------------------------------------------------

Route::get('/meusprocessos', [App\Http\Controllers\MeusProcessosController::class, 'meusprocessos'])->name('meusprocessos');

Route::get('/meusprocessos/processos', [App\Http\Controllers\MeusProcessosController::class, 'processos'])->name('meusprocessos.processos');

Route::get('/meusprocessos/processos/Search/{search?}', [App\Http\Controllers\MeusProcessosController::class, 'processosSearch'])->name('meusprocessos.processosSearch');

Route::get('/meusprocessos/processosConfirmado', [App\Http\Controllers\MeusProcessosController::class, 'processosConfirmados'])->name('meusprocessos.processosConfirmados');

Route::get('/meusprocessos/processosProcessados', [App\Http\Controllers\MeusProcessosController::class, 'processosProcessados'])->name('meusprocessos.processosProcessados');

Route::get('/meusprocessos/processosAbertos', [App\Http\Controllers\MeusProcessosController::class, 'processosAbertos'])->name('meusprocessos.processosAbertos');

Route::get('/meusprocessos/processosAnulados', [App\Http\Controllers\MeusProcessosController::class, 'processosAnulados'])->name('meusprocessos.processosAnulados');

Route::get('/meusprocessos/processosConcluidos', [App\Http\Controllers\MeusProcessosController::class, 'processosConcluidos'])->name('meusprocessos.processosConcluidos');

Route::get('/meusprocessos/processo/{id?}', [App\Http\Controllers\MeusProcessosController::class, 'processo'])->name('meusprocessos.processo');

Route::post('/meusprocessos/save', [\App\Http\Controllers\MeusProcessosController::class, 'meusprocessosSave'])->name('meusprocessos.save');

Route::post('/meusprocessos/update/{id?}', [\App\Http\Controllers\MeusProcessosController::class, 'update'])->name('meusprocessos.update');

Route::post('/meusprocessos/delete/{id?}', [\App\Http\Controllers\MeusProcessosController::class, 'delete'])->name('meusprocessos.delete');

Route::post('/meusprocessos/arquivar/{id?}', [\App\Http\Controllers\MeusProcessosController::class, 'arquivar'])->name('meusprocessos.arquivar');

//Perfil-----------------------------------------------------------------------------------------
Route::get('perfil',[PerfilController::class,'index'])->name('perfil');

Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change.password');


//Funcionarios------------------------------------------------------------------------------------

Route::get('/funcionarioslist', [\App\Http\Controllers\FuncionariosController::class,'funcionarioslist'])->name('funcionarioslist');

Route::get('/admin/funcionarios', [\App\Http\Controllers\FuncionariosController::class,'funcionarios'])->name('admin.funcionarios');

Route::get('/admin/funcionario/filtro/{identificador?}', [\App\Http\Controllers\FuncionariosController::class,'filtro'])->name('admin.funcionarios.filtro');

Route::get('/admin/funcionarios/direcao', [\App\Http\Controllers\FuncionariosController::class,'direcao'])->name('admin.funcionarios.direcao');

Route::get('/admin/funcionarios/informatica', [\App\Http\Controllers\FuncionariosController::class,'informatica'])->name('admin.funcionarios.informatica');

Route::get('/admin/funcionarios/contabilidade', [\App\Http\Controllers\FuncionariosController::class,'contabilidade'])->name('admin.funcionarios.contabilidade');

Route::get('/admin/funcionario/{id?}',[\App\Http\Controllers\FuncionariosController::class, 'funcionario'])->name('admin.funcionario');

Route::post('/admin/update/{id?}', [\App\Http\Controllers\FuncionariosController::class, 'update'])->name('funcionario.update');

Route::post('/admin/save', [\App\Http\Controllers\FuncionariosController::class, 'save'])->name('funcionario.save');

Route::get('/admin/funcionario/Search/{search?}', [\App\Http\Controllers\FuncionariosController::class, 'funcionariosSearch'])->name('admin.funcionariosSearch');

Route::post('/admin/delete/{id?}', [\App\Http\Controllers\FuncionariosController::class, 'delete'])->name('funcionario.delete');


//Departamentos------------------------------------------------------------------------------------

Route::get('/departamentoslist', [\App\Http\Controllers\DepartamentosController::class,'departamentoslist'])->name('departamentoslist');

Route::get('/admin/departamentos', [\App\Http\Controllers\DepartamentosController::class,'departamentos'])->name('admin.departamentos');

Route::get('/admin/departamento/{id?}', [\App\Http\Controllers\DepartamentosController::class, 'departamento'])->name('admin.departamento');

Route::post('/admin/departamento/update/{id?}', [\App\Http\Controllers\DepartamentosController::class, 'update'])->name('departamento.update');

Route::post('/admin/departamento/save', [\App\Http\Controllers\DepartamentosController::class, 'save'])->name('departamento.save');

Route::post('/admin/departamento/delete/{id?}', [\App\Http\Controllers\DepartamentosController::class, 'delete'])->name('departamento.delete');

//Arquivos

Route::get('/arquivo', [App\Http\Controllers\ArquivosController::class, 'arquivo'])->name('arquivo');





<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerfilController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Mailbox-------------------------------------------------------
Route::get('/mailbox', [App\Http\Controllers\MailBoxController::class, 'mailbox'])->name('mailbox');

Route::get('/mailbox/emails', [App\Http\Controllers\MailBoxController::class, 'emails'])->name('mailbox.emails');

Route::get('/mailbox/emailsnew', [App\Http\Controllers\MailBoxController::class, 'emailsnew'])->name('mailbox.emailsnew');

Route::get('/mailbox/emailsseen', [App\Http\Controllers\MailBoxController::class, 'emailsseen'])->name('mailbox.emailsseen');

Route::get('/mailbox/emailssearch', [App\Http\Controllers\MailBoxController::class, 'emailssearch'])->name('mailbox.emailssearch');

Route::get('/mailbox/email/{id?}', [App\Http\Controllers\MailBoxController::class, 'email'])->name('mailbox.email');


//Processos---------------------------------------------------------------------------------------------------------------

Route::get('/meusprocessos', [App\Http\Controllers\MeusProcessosController::class, 'meusprocessos'])->name('meusprocessos');

Route::get('/meusprocessos/processos', [App\Http\Controllers\MeusProcessosController::class, 'processos'])->name('meusprocessos.processos');

Route::get('/meusprocessos/processosConfirmado', [App\Http\Controllers\MeusProcessosController::class, 'processosConfirmados'])->name('meusprocessos.processosConfirmados');

Route::get('/meusprocessos/processosProcessados', [App\Http\Controllers\MeusProcessosController::class, 'processosProcessados'])->name('meusprocessos.processosProcessados');

Route::get('/meusprocessos/processosAbertos', [App\Http\Controllers\MeusProcessosController::class, 'processosAbertos'])->name('meusprocessos.processosAbertos');

Route::get('/meusprocessos/processosAnulados', [App\Http\Controllers\MeusProcessosController::class, 'processosAnulados'])->name('meusprocessos.processosAnulados');

Route::get('/meusprocessos/processosConcluidos', [App\Http\Controllers\MeusProcessosController::class, 'processosConcluidos'])->name('meusprocessos.processosConcluidos');

Route::get('/meusprocessos/processo/{id?}', [App\Http\Controllers\MeusProcessosController::class, 'processo'])->name('meusprocessos.processo');

Route::post('/meusprocessos/save', [\App\Http\Controllers\MeusProcessosController::class, 'meusprocessosSave'])->name('meusprocessos.save');

Route::post('/meusprocessos/update/{id?}', [\App\Http\Controllers\MeusProcessosController::class, 'update'])->name('meusprocessos.update');

Route::post('/meusprocessos/delete/{id?}', [\App\Http\Controllers\MeusProcessosController::class, 'delete'])->name('meusprocessos.delete');

Route::get('perfil',[PerfilController::class,'index'])->name('perfil');


//Funcionarios------------------------------------------------------------------------------------

Route::get('/funcionarioslist', [\App\Http\Controllers\FuncionariosController::class,'funcionarioslist'])->name('funcionarioslist');

Route::get('/admin/funcionarios', [\App\Http\Controllers\FuncionariosController::class,'funcionarios'])->name('admin.funcionarios');

Route::get('/admin/funcionario/{id?}',[\App\Http\Controllers\FuncionariosController::class, 'funcionario'])->name('admin.funcionario');

//Route::post('/admin/funcionario/{user}',[App])

Route::middleware(['auth'])->group(function () {
    Route::get('funcionarios',[PerfilController::class,'funcionarios'])->name('funcionarios');
    Route::post('perfil/{user}',[PerfilController::class,'update'])->name('perfil.update');
});


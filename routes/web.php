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

Route::get('/meusprocessos/processosConfirmado', [App\Http\Controllers\MeusProcessosController::class, 'processosConfirmado'])->name('processos.processosConfirmado');

Route::get('/meusprocessos/processosProcessado', [App\Http\Controllers\MeusProcessosController::class, 'processosProcessado'])->name('processos.processosProcessado');

Route::get('/meusprocessos/processosAberto', [App\Http\Controllers\MeusProcessosController::class, 'processosAberto'])->name('processos.processosAberto');

Route::get('/meusprocessos/processosAnulado', [App\Http\Controllers\MeusProcessosController::class, 'processosAnulado'])->name('processos.processosAnulado');

Route::get('/meusprocessos/processosConcluido', [App\Http\Controllers\MeusProcessosController::class, 'processosConcluido'])->name('processos.processosConcluido');

Route::get('/meusprocessos/processo/{id?}', [App\Http\Controllers\MeusProcessosController::class, 'processo'])->name('meusprocessos.processo');

Route::post('/meusprocessos/save', [\App\Http\Controllers\MeusProcessosController::class, 'meusprocessosSave'])->name('meusprocessos.save');

Route::middleware(['auth'])->group(function () {
    Route::get('perfil',[PerfilController::class,'index'])->name('perfil');
    Route::post('perfil/{user}',[PerfilController::class,'update'])->name('perfil.update');
});

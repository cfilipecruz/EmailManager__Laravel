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

Route::get('/mailbox', [App\Http\Controllers\MailBoxController::class, 'mailbox'])->name('mailbox');

Route::get('/mailbox/emails', [App\Http\Controllers\MailBoxController::class, 'emails'])->name('mailbox.emails');

Route::get('/mailbox/emailsnew', [App\Http\Controllers\MailBoxController::class, 'emailsnew'])->name('mailbox.emailsnew');

Route::get('/mailbox/emailsseen', [App\Http\Controllers\MailBoxController::class, 'emailsseen'])->name('mailbox.emailsseen');

Route::get('/mailbox/emailssearch', [App\Http\Controllers\MailBoxController::class, 'emailssearch'])->name('mailbox.emailssearch');

Route::get('/mailbox/email/{id?}', [App\Http\Controllers\MailBoxController::class, 'email'])->name('mailbox.email');

Route::get('/meusprocessos', [App\Http\Controllers\MeusProcessosController::class, 'meusprocessos'])->name('meusprocessos');

Route::middleware(['auth'])->group(function () {
    Route::get('perfil',[PerfilController::class,'index'])->name('perfil');
    Route::post('perfil/{user}',[PerfilController::class,'update'])->name('perfil.update');
  });

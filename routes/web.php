<?php
/*
 * Projeto: url-shortener
 * Arquivo: web.php
 * ---------------------------------------------------------------------
 * Autor: Leonardo Nascimento
 * E-mail: leonardo.nascimento21@gmail.com
 * ---------------------------------------------------------------------
 * Modificado por: Leonardo Nascimento - <leonardo.nascimento21@gmail.com>
 * ---------------------------------------------------------------------
 * Copyright (c) 2021 Leonardo
 * HISTORY:
 * Date      	By	Comments
 * ----------	---	---------------------------------------------------------
 */
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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();



Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'painel', 'namespace' => 'App\Http\Controllers\Backend', 'middleware' => 'auth', 'as' => 'backend.'], function()
	{
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('/encurtar', 'ShortLinkController');

    });
});

Route::get('/{link}', [App\Http\Controllers\HomeController::class, 'redirect'])->name('redirect.link');

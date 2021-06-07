<?php
/*
 * Projeto: urlshortener
 * Arquivo: api.php
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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::prefix( 'v1')->name('api.')->namespace('App\Http\Controllers\Api')->group(function()

	{
			Route::get('/encurtar/{link?}/{shortlink?}/{expire?}','ShortlinkApiController@store')->name('store.get');
			Route::post('/encurtar/{link?}/{shortlink?}/{expire?}','ShortlinkApiController@store')->name('store.post');
			Route::get('/lista','ShortlinkApiController@listApi');
			Route::get('/{link}','ShortlinkApiController@redirect');
});

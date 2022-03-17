<?php

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

Route::post('login', 'API\ApiAuthController@login');
Route::post('register', 'API\ApiAuthController@register');
Route::post('cabang', 'API\ApiCabangController@cabang');

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('logout', 'API\ApiAuthController@logout');
    
    // CRUD User
    Route::resource('users', 'API\ApiUserController');

    // CRUD Cabang
    Route::post('details_cabang/{id}', 'API\ApiCabangController@details_cabang');
    Route::post('create_cabang', 'API\ApiCabangController@create_cabang');
    Route::post('update_cabang', 'API\ApiCabangController@update_cabang');
    Route::delete('delete_cabang', 'API\ApiCabangController@delete_cabang');
});

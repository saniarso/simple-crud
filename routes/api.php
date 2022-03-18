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
Route::get('cabang', 'API\ApiCabangController@index');

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('logout', 'API\ApiAuthController@logout');
    
    // CRUD User
    Route::resource('users', 'API\ApiUserController');

    // CRUD Cabang
    // Route::resource('cabang', 'API\ApiCabangController');
    Route::get('cabang/{id}', 'API\ApiCabangController@show');
    Route::post('cabang', 'API\ApiCabangController@store');
    Route::put('cabang/{id}', 'API\ApiCabangController@update');
    Route::delete('cabang/{id}', 'API\ApiCabangController@destroy');
});

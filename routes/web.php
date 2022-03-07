<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::resource('/', 'HomeController');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

Auth::routes();

Auth::routes(['verify' => true]);

Route::get('/cetak_pdf', 'UsersController@cetak_pdf')->name('cetak_pdf');
Route::match(['GET', 'HEAD'], '/user_excel', 'UsersController@user_excel')->name('user_excel');

Route::group(['middleware' => ['role:1']], function() {
    Route::get('/admin_excel', 'UsersController@admin_excel')->name('admin_excel');
});

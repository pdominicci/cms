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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/frutipera', function(){
    dd('frutipera');
});
// Route::get('/login', 'ConnectController@getLogin')->name('login');
// Route::post('/login', 'ConnectController@postLogin')->name('login');
// Route::get('/register', 'ConnectController@getRegister')->name('register');
// Route::post('/register', 'ConnectController@postRegister')->name('register');
// Route::get('/recover', 'ConnectController@getRecover')->name('recover');
// Route::post('/recover', 'ConnectController@postRecover')->name('recover');
// Route::get('/logout', 'ConnectController@getLogout')->name('logout');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('/dashboard');
})->name('dashboard');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MeetsController;
use App\Http\Controllers\GensettsController;
use App\Http\Controllers\FederationsController;

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
    return view('welcome');
});
Route::get('/profile', function () {
    return view('back_layouts.users.user_profile');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Back routes //
Route::get('/profile', function () {
    return view('back_layouts.users.user_profile');
});
Route::resource('users', UsersController::class);
//Route::get('/korisnici','UsersController@index');
//Route::get('brisi_korisnika/{id}','UsersController@destroy');

Route::get('/create_meet', function () {
    return view('back_layouts.meets.new_meet');
});
Route::resource('meets', MeetsController::class);
Route::get('/meets', [MeetsController::class, 'index']);
Route::get('/meet', [MeetsController::class, 'show']);
Route::get('delete/{id}',[MeetsController::class, 'destroy']);

Route::resource('gensetts', GensettsController::class);

Route::resource('federations', FederationsController::class);
Route::get('/federations', [FederationsController::class, 'index']);
Route::get('del_fed/{id}',[FederationsController::class, 'destroy']);

// Front routes //

Route::get('/active_meets', [MeetsController::class, 'front_index']);
Route::get('meet/{id}',[MeetsController::class, 'front_show']);

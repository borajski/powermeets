<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MeetsController;
use App\Http\Controllers\GensettsController;
use App\Http\Controllers\FederationsController;
use App\Http\Controllers\NominationsController;
use App\Models\Meet;

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
    $query = (new Meet())->newQuery();
    $natjecanja = $query->orderBy('datump')->get();  
    return view('welcome')->with('natjecanja',$natjecanja);
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

Route::resource('meets', MeetsController::class);
Route::get('/meets', [MeetsController::class, 'index']);
Route::get('/create_meet', [MeetsController::class, 'create']);
Route::get('/meet', [MeetsController::class, 'show']);
Route::get('delete/{id}',[MeetsController::class, 'destroy']);

Route::resource('gensetts', GensettsController::class);

Route::resource('federations', FederationsController::class);
Route::get('/federations', [FederationsController::class, 'index']);
Route::get('del_fed/{id}',[FederationsController::class, 'destroy']);
Route::get('fedRules/{id}',[FederationsController::class, 'fedRules']);
Route::get('meets/fedRules/{id}',[FederationsController::class, 'fedRules']);
Route::get('meet/weightCat/{id}',[FederationsController::class, 'weightCat']);
Route::get('meet/ageCat/{id}',[FederationsController::class, 'ageCat']);

// Front routes //


Route::get('meet/{id}',[MeetsController::class, 'front_show'])->name('front_meet');

Route::resource('nominations', NominationsController::class);

Route::get('/about', function () {
    return view('front_layouts.general.about');
});

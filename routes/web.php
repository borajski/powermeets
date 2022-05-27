<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MeetsController;
use App\Http\Controllers\GensettsController;
use App\Http\Controllers\FederationsController;
use App\Http\Controllers\NominationsController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\AthletesController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BarsController;
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
})->name('start');
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

Route::resource('nominations', NominationsController::class);
Route::get('/nominations', [NominationsController::class, 'show']);
Route::get('nominations/nomList/{discipline}',[NominationsController::class, 'nomList']);

Route::resource('athletes', AthletesController::class);
Route::get('athletes/athletesList/{discipline}',[AthletesController::class, 'athletesList']);
Route::get('/start_managing/{id}',[AthletesController::class, 'initiate']);
Route::post('/group',[AthletesController::class, 'group']);
Route::get('athletes/groupesList/{discipline}',[AthletesController::class, 'groupesList']);
Route::get('athletes/rackHeights/{discipline}',[AthletesController::class, 'rackHeights']);
Route::get('athletes/weighing/{discipline}',[AthletesController::class, 'weighing']);
Route::get('/weighing_lists/{discipline}',[AthletesController::class, 'weighingList']);
Route::get('/athlete/{id}',[AthletesController::class, 'showAthlete']);
Route::post('/setrack',[AthletesController::class, 'setRack']);

Route::resource('results', ResultsController::class);
Route::get('results/groupes/{discipline}',[ResultsController::class, 'groupes']);
Route::get('/competition/{input}',[ResultsController::class, 'showGroup']);
Route::get('/competition/inputWeight/{input}',[ResultsController::class, 'inputWeight']);
Route::get('/competition/inputLift/{input}',[ResultsController::class, 'inputLift']);
Route::get('/competition_results/{id}',[ResultsController::class, 'showResults']);
Route::get('competition_results/resList/{discipline}',[ResultsController::class, 'resList']);

Route::resource('bars', BarsController::class);
// Front routes //
Route::get('meet/{id}',[MeetsController::class, 'front_show'])->name('front_meet');
Route::get('/send', [EmailsController::class, 'send'])->name('send');
Route::get('meet/nomList/{discipline}',[NominationsController::class, 'nomList']);

//PDF Controller
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);



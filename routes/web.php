<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [ContactController::class, "index"])->name('dashboard');
    //contact
Route::resource('/contact', ContactController::class);
// all contact
Route::get('/contact', [ContactController::class, "allc"])->name('allc');
Route::get('/contact/trashed', [ContactController::class, "trashed"])->name('trashed');
});

// search
Route::get('/search/', [ContactController::class, "search"])->name('search');
// add favorite 
Route::post('/favorite/{id}', [ContactController::class, "favorite"])->name('favorite');
// favorite
Route::resource('/favorite', FavoriteController::class);
// delete favorite
Route::post('/destroy/{con_id}', [FavoriteController::class, "destroy"])->name('destroy');



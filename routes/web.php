<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TfidfController;
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

Route::get('/', [MainController::class, 'index'])->name('mainIndex');
Route::match(array('PUT', 'PATCH'), '/data/{id}', [MainController::class, 'perbaruiData'])->name('perbaruiData');
Route::match(array('PUT', 'PATCH'), '/token-tidak-lolos/{id}', [MainController::class, 'tambahTokenTidakLolos'])->name('tambahTokenTidakLolos');
Route::match(array('PUT', 'PATCH'), '/token-lolos/{id}', [MainController::class, 'tambahTokenLolos'])->name('tambahTokenLolos');
Route::match(array('PUT', 'PATCH'), '/hasil-stemming/{id}', [MainController::class, 'perbaruiHasilStemming'])->name('perbaruiHasilStemming');

Route::get('/tfidf', [TfidfController::class, 'index'])->name('tfidfIndex');
Route::match(array('PUT', 'PATCH'), '/tfidf/artikel/{id}', [TfidfController::class, 'perbaruiArtikel'])->name('perbaruiArtikel');

// Route::get('/', function () {
//     return view('welcome');
// });

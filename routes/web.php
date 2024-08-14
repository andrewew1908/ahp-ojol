<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaComparisonController;
use App\Http\Controllers\AlternativeComparisonController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/proses-login', [LoginController::class, 'prosesLogin'])->name('proses-login');
Route::get('/proses-logout', [LoginController::class, 'prosesLogout'])->name('proses-logout');


//alternative
Route::resource('alternatives', AlternativeController::class);
// Route::get('criteria-comparisons', [CriteriaComparisonController::class, 'index'])->name('criteria_comparisons.index');
// Route::post('criteria-comparisons', [CriteriaComparisonController::class, 'store'])->name('criteria_comparisons.store');
//perbandingan alternative
Route::resource('alternative-comparisons', AlternativeComparisonController::class);

//rangking
Route::resource('results', ResultController::class);


Route::group(['middleware' => 'auth'], function() {
    //criteria
    Route::resource('criteria', CriteriaController::class);

    //perbandingan criteria
    Route::resource('criteria_comparisons', CriteriaComparisonController::class);
});

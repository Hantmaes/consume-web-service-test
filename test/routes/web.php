<?php

use Illuminate\Support\Facades\Route;

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
    return view('data');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/data', [App\Http\Controllers\GuzzleController::class, 'show']);

Route::post('/form', [App\Http\Controllers\GuzzleController::class, 'getRemoteData'])->name('form');

Route::get('/icos', [App\Http\Controllers\GuzzleController::class, 'list'])->name('icos');

Route::get('/table', [App\Http\Controllers\GuzzleController::class, 'table'])->name('tables');

Route::post('/sendEmail', [App\Http\Controllers\GuzzleController::class, 'sendEmail'])->name('sendEmail');


Route::get('feed', [App\Http\Controllers\GuzzleController::class, 'feed']);


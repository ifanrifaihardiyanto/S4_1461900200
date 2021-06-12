<?php

use App\Http\Controllers\DataRSController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PasienController;
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

Route::get('/', [IndexController::class, 'index']);
Route::resource('dataRS', DataRSController::class);
Route::resource('dokter', DokterController::class);
Route::resource('pasien', PasienController::class);

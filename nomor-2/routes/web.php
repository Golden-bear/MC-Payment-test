<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;
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

Route::get('/', [KeuanganController::class, 'index'])->name('keuangan');
Route::post('/keuangan/insert', [KeuanganController::class, 'insert']);
Route::post('/keuangan/update/{id}', [KeuanganController::class, 'update']);
Route::get('/keuangan/delete/{id}', [KeuanganController::class, 'delete']);

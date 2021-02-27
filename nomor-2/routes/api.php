<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganApi;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/transaksi', [KeuanganApi::class, 'semua']);
Route::post('/insert-transaksi', [KeuanganApi::class, 'post_transaksi']);
Route::put('/update-transaksi/{id}', [KeuanganApi::class, 'put']);
Route::delete('/delete-transaksi/{id}', [KeuanganApi::class, 'delete']);


Route::get('/pemasukan', [KeuanganApi::class, 'pemasukans']);
Route::get('/detail-pemasukan/{id}', [KeuanganApi::class, 'get_detail_pemasukan']);


Route::get('/pengeluaran', [KeuanganApi::class, 'pengeluarans']);
Route::get('/detail-pengeluaran/{id}', [KeuanganApi::class, 'get_detail_pengeluaran']);

Route::get('/sisa', [KeuanganApi::class, 'sisa']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

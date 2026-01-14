<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/lokasi', 'LokasiController@getAll');
Route::get('/barang', 'BarangController@getAll');
Route::get('/program', 'ProgramController@getAll');
Route::get('/stok', 'StokController@getAll');
Route::get('/stok/total', 'StokController@getTotalStok');
Route::get('/riwayat', 'RiwayatTransaksiController@getAll');
Route::post('/transaksi', 'RiwayatTransaksiController@insert');
Route::get('/stok/laporan', 'StokController@getLaporanStok');
Route::get('/transaksi/laporan', 'RiwayatTransaksiController@getLaporanTransaksi');
Route::get('/stok/check', 'StokController@checkStok');
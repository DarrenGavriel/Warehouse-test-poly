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

// Route::get('/lokasi', 'LokasiController@getAll');
// Route::get('/barang', 'BarangController@getAll');
Route::get('/program', 'ProgramController@getAll');
Route::prefix('stok')->group(function () {
    Route::get('/', 'StokController@getAll');
    // Route::get('/check', 'StokController@checkStok');
    Route::get('/laporan', 'StokController@getLaporanStok');
});
Route::prefix('transaksi')->group(function () {
    Route::get('/', 'RiwayatTransaksiController@getAll');
    Route::post('/', 'RiwayatTransaksiController@insert');
    Route::get('/laporan', 'RiwayatTransaksiController@getLaporanTransaksi');
});
Route::prefix('lokasi')->group(function () {
    Route::get('/', 'LokasiController@getAll');
    Route::post('/', 'LokasiController@createLokasi');
    Route::delete('/{id}', 'LokasiController@deleteLokasi');
    Route::put('/{id}', 'LokasiController@updateLokasi');
    Route::get('/{id}', 'LokasiController@getLokasiById');
});
Route::prefix('barang')->group(function () {
    Route::get('/', 'BarangController@getAll');
    Route::post('/', 'BarangController@insert');
    Route::delete('/{id}', 'BarangController@deleteBarang');
    Route::put('/{id}', 'BarangController@updateBarang');
    Route::get('/{id}', 'BarangController@getById');
});
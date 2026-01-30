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

Route::get('/program', 'ProgramController@getAll');
Route::prefix('stok')->group(function () {
    Route::get('/', 'StokController@getAll');
    Route::get('/laporan', 'StokController@getLaporanStok');
    Route::get('/laporan/eager', 'StokController@getStokEager');
});
Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/', 'RiwayatTransaksiController@getAll')->name('index');
    Route::post('/', 'RiwayatTransaksiController@insert')->name('store');
    Route::get('/laporan', 'RiwayatTransaksiController@getLaporanTransaksi')->name('laporan');
    Route::get('/laporan/eager', 'RiwayatTransaksiController@getAllRiwayatTransaksi')->name('laporan.eager');
});
Route::prefix('lokasi')->name('lokasi.')->group(function () {
    Route::get('/', 'LokasiController@getAll')->name('index');
    Route::post('/', 'LokasiController@createLokasi')->name('store');
    Route::delete('/{id}', 'LokasiController@deleteLokasi')->name('destroy');
    Route::put('/{id}', 'LokasiController@updateLokasi')->name('update');
    Route::get('/{id}', 'LokasiController@getLokasiById')->name('show');
});
Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/', 'BarangController@getAll')->name('index');
    Route::post('/', 'BarangController@insert')->name('store');
    Route::delete('/{id}', 'BarangController@deleteBarang')->name('destroy');
    Route::put('/{id}', 'BarangController@updateBarang')->name('update');
    Route::get('/{id}', 'BarangController@getById')->name('show');
});
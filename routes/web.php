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
    return view('Stok.show_dt');
});
Route::get('/stok/laporan', function () {
    return view('Stok.show_dt_eager');
});
Route::get('/transaksi/laporan', function () {
    return view('Transaksi.show');
});
Route::get('/lokasi/master', function () {
    return view('Lokasi.show_dt');
});
Route::get('/barang/master', function () {
    return view('Barang.show_dt');
});
Route::get('/test', function () {
    return view('test');
});
Route::post('/transaksi/insert', 'RiwayatTransaksiController@insert')->name('create-transaksi');

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
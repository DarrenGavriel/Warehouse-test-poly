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
    return view('Stok.show_dt');
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
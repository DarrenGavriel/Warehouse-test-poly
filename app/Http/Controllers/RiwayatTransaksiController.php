<?php

namespace App\Http\Controllers;

use App\RiwayatTransaksi;
use App\Lokasi;
use App\Stok;
use App\Barang;
use App\Program;
use App\DetailRiwayatTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new RiwayatTransaksi();
    }
    public function getLaporanTransaksi(Request $request)
    {
        try {
            $data = $this->model->getLaporanTransaksi(
                $request->input('bukti'),
                $request->input('tanggal_transaksi'),
                $request->input('id_barang'),
                $request->input('id_lokasi')
            );
            if (!$data || $data->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 404,
                    'message' => 'Laporan transaksi tidak ditemukan',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mendapatkan laporan transaksi',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mendapatkan laporan transaksi error: '.$e->getMessage(),
            ], 500);
        }
    }
    public function getAll()
    {
        try {
            $data = $this->model->getAll();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Riwayat transaksi berhasil didapatkan',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mendapatkan riwayat transaksi error: '.$e->getMessage(),
            ], 500);
        }
    }
    public function insert(Request $request)
    {
        try {
            // Konversi string kosong jadi null
            $input = $request->all();
            foreach (['id_lokasi', 'id_barang', 'id_program'] as $field) {
                if (isset($input[$field]) && trim($input[$field]) === '') {
                    $input[$field] = null;
                }
            }
            $request->merge($input);
            // Mengganti T pada tanggal transaksi dengan spasi
            $request->merge([
                'tgl_transaksi' => str_replace('T', ' ', $request->tgl_transaksi)
            ]);
            // input di validasi
            $validator = $this->validateInsert($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'validasi gagal',
                    'errors' => $validator->errors(),
                ], 400);
            }
            $jenis_transaksi = $request->jenis_transaksi;
            $id_lokasi = $request->id_lokasi;
            $id_barang = $request->id_barang;
            $id_program = $request->id_program;
            $tgl_transaksi = $request->tgl_transaksi;
            $quantity = $request->quantity;
            $bukti = $request->bukti;
            // ini buat validasi tanggal transaksi dan total saldo
            $stok = new Stok();
            $total = $stok->totalStok($id_barang, $id_lokasi);
            if (!$total) {
                $total_saldo = 0;
                $terakhir_masuk = null;
            } else {
                $total_saldo = $total->total_saldo;
                $terakhir_masuk = $total->terakhir_masuk;
            }

            // Cek tanggal transaksi harus setelah tanggal terakhir masuk
            if ($terakhir_masuk != null && $terakhir_masuk > $tgl_transaksi) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Tanggal transaksi harus setelah '.$terakhir_masuk,
                ], 400);
            }
            // Cek stok mencukupi atau tidak
            if ($jenis_transaksi == 'keluar' && $total_saldo < $quantity) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Stok tidak mencukupi',
                ], 400);
            } elseif ($jenis_transaksi == 'keluar' && $total_saldo > $quantity) {
                DB::transaction(function () use (
                    $tgl_transaksi,
                    $bukti,
                    $id_barang,
                    $id_lokasi,
                    $id_program,
                    $quantity,
                    $stok
                ){
                    $createRiwayat = RiwayatTransaksi::create([
                        'waktu_transaksi' => $tgl_transaksi,
                        'bukti' => $bukti,
                        'id_barang' => $id_barang,
                        'id_lokasi' => $id_lokasi,
                        'id_program' => $id_program,
                    ]);
                    $check = $stok->checkStok($id_barang, $id_lokasi);
                    if ($check != null) {
                        $jumlah_baris_stok = count($check);
                        if ($check[0]->saldo >= $quantity) {
                            // update stok
                            Stok::where('id', $check[0]->id)->update([
                                'saldo' => $check[0]->saldo - $quantity,
                            ]);
                            // buat detail riwayat transaksi
                            DetailRiwayatTransaksi::create([
                                'id_riwayat_transaksi' => $createRiwayat->id,
                                'id_stok' => $check[0]->id,
                                'jumlah_transaksi' => -$quantity,
                            ]);
                        } elseif ($check[0]->saldo < $quantity) {
                            $sisa_quantity = $quantity;
                            for ($i = 0; $i < $jumlah_baris_stok; $i++) {
                                if ($check[$i]->saldo >= $sisa_quantity) {
                                    // update stok
                                    Stok::where('id', $check[$i]->id)->update([
                                        'saldo' => $check[$i]->saldo - $sisa_quantity,
                                    ]);
                                    // buat detail riwayat transaksi
                                    DetailRiwayatTransaksi::create([
                                        'id_riwayat_transaksi' => $createRiwayat->id,
                                        'id_stok' => $check[$i]->id,
                                        'jumlah_transaksi' => -$sisa_quantity,
                                    ]);
                                    break;
                                } elseif ($check[$i]->saldo < $sisa_quantity) {
                                    // update stok
                                    Stok::where('id', $check[$i]->id)->update([
                                        'saldo' => 0,
                                    ]);
                                    // buat detail riwayat transaksi
                                    DetailRiwayatTransaksi::create([
                                        'id_riwayat_transaksi' => $createRiwayat->id,
                                        'id_stok' => $check[$i]->id,
                                        'jumlah_transaksi' => -$check[$i]->saldo,
                                    ]);
                                    $sisa_quantity -= $check[$i]->saldo;
                                }
                            }
                        }
                    } else {
                        throw new \Exception('Stok tidak mencukupi');
                    }
                });
                return response()->json([
                    'success' => true,
                    'http_status' => 201,
                    'message' => 'Transaksi berhasil dicatat',
                ], 201);
            // kalau jenis transaksi masuk
            } elseif ($jenis_transaksi == 'masuk'){
                DB::transaction(function () use (
                    $tgl_transaksi,
                    $bukti,
                    $id_barang,
                    $id_lokasi,
                    $id_program,
                    $quantity,
                    $stok
                ){
                    // buat riwayat transaksi
                    $createRiwayat = RiwayatTransaksi::create([
                        'waktu_transaksi' => $tgl_transaksi,
                        'bukti' => $bukti,
                        'id_lokasi' => $id_lokasi,
                        'id_barang' => $id_barang,
                        'id_program' => $id_program,
                    ]);
                    // buat stok baru
                    $stokBaru = Stok::create([
                        'tanggal_masuk' => $tgl_transaksi,
                        'saldo' => $quantity,
                        'id_lokasi' => $id_lokasi,
                        'id_barang' => $id_barang,
                    ]);
                    // buat detail riwayat transaksi
                    DetailRiwayatTransaksi::create([
                        'id_riwayat_transaksi' => $createRiwayat->id,
                        'id_stok' => $stokBaru->id,
                        'jumlah_transaksi' => $quantity,
                    ]);
                });
                return response()->json([
                    'success' => true,
                    'http_status' => 201,
                    'message' => 'Transaksi berhasil dicatat',
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mencatat transaksi',
            ], 500);
        }
    }
    public function getTotalStok(Request $request)
    {
        try {
            $id_barang = $request->id_barang;
            $id_lokasi = $request->id_lokasi;
            $data = $this->model->totalStok($id_barang, $id_lokasi);
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil total stok',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil total stok',
            ], 500);
        }
    }
    // buat validasi input user pada buat transaksi
    private function validateInsert(Request $request)
    {
        return Validator::make($request->all(), 
        [
            'jenis_transaksi' => 'required|string|in:masuk,keluar',
            'bukti' => 'required|string|max:15',
            'id_lokasi' => 'required|integer|exists:lokasi,id',
            'id_barang' => 'required|integer|exists:barang,id',
            'tgl_transaksi' => 'required|date|date_format:Y-m-d H:i',
            'quantity' => 'required|integer|min:1',
            'id_program' => 'required|integer|exists:program,id',
        ],
        [
            'required' => ':attribute wajib diisi',
            'string' => ':attribute harus berupa string',
            'integer' => ':attribute harus berupa angka',
            'max' => ':attribute maksimal :max karakter',
            'in' => ':attribute harus diantara :values',
            'exists' => ':attribute tidak ditemukan di database',
            'dateTime' => ':attribute harus berupa tanggal yang valid',
            'min' => ':attribute minimal :min',
            'date_format' => ':attribute tidak sesuai format Y-m-d H:i',
        ],
        [
            'jenis_transaksi' => 'Jenis transaksi',
            'bukti' => 'Bukti',
            'id_lokasi' => 'Kode Lokasi',
            'id_barang' => 'Kode barang',
            'tgl_transaksi' => 'Tanggal transaksi',
            'quantity' => 'Kuantitas',
            'id_program' => 'Program',
        ]);
    }
}

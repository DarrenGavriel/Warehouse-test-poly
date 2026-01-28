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
            // Konversi format tanggal dari d/m/Y ke Y-m-d jika ada
            $tanggalTransaksi = $request->input('tanggal_transaksi');
            if ($tanggalTransaksi) {
                $dateTime = \DateTime::createFromFormat('d/m/Y', $tanggalTransaksi);
                if ($dateTime) {
                    $tanggalTransaksi = $dateTime->format('Y-m-d');
                }
            }
            
            $data = $this->model->getLaporanTransaksi(
                $request->input('bukti'),
                $tanggalTransaksi,
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
    public function insert(Request $request)
    {
        try {
            // Konversi string kosong jadi null
            $input = $request->all();
            $request->merge($input);
            
            // Konversi format tanggal dari d/m/Y H:i ke Y-m-d H:i
            if ($request->tgl_transaksi) {
                $tgl = $request->tgl_transaksi;
                // Parse format Indonesia: 26/01/2026 14:30
                $dateTime = \DateTime::createFromFormat('d/m/Y H:i', $tgl);
                if ($dateTime) {
                    $request->merge([
                        'tgl_transaksi' => $dateTime->format('Y-m-d H:i')
                    ]);
                }
            }
            
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

            // $check_bukti = RiwayatTransaksi::where('bukti', $bukti)->first();
            // if ($check_bukti) {
            //     return response()->json([
            //         'success' => false,
            //         'http_status' => 400,
            //         'message' => 'Bukti transaksi sudah digunakan',
            //     ], 400);
            // }

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
            } else {
                DB::transaction(function () use (
                    $jenis_transaksi,
                    $tgl_transaksi,
                    $id_barang,
                    $id_lokasi,
                    $id_program,
                    $quantity,
                    $stok
                ){
                    $bukti = $this->generateBukti($jenis_transaksi);
                    $createRiwayat = RiwayatTransaksi::create([
                        'waktu_transaksi' => $tgl_transaksi,
                        'bukti' => $bukti,
                        'id_barang' => $id_barang,
                        'id_lokasi' => $id_lokasi,
                        'id_program' => $id_program,
                    ]);
                    if ($jenis_transaksi == 'keluar'){
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
                        }
                    } else {
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
                    }
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
        };
    }
    private function generateBukti($jenis_transaksi)
    {
        $jenis = $jenis_transaksi;
        if ($jenis == 'masuk') {
            $bukti_prefix = 'TAMBAH';
        } else if ($jenis == 'keluar') {
            $bukti_prefix = 'KELUAR';
        }
        
        // mengambil bukti terakhir dari jenis transaksi yang sama
        $lastBukti = $this->model->getRiwayatTransaksiByBukti($bukti_prefix);
        // kita mengecek apakah ada bukti terakhir
        // if ($lastBukti != null) {
        //     // kalau ada kita ambil angkanya saja (ex. "TAMBAH123" -> 123)
        //     $lastNumber = count($lastBukti) > 0;
        //     $newNumber = $lastNumber + 1;
        // } else {
        //     // Disini kalau gak ada, berarti ini bukti pertama
        //     $newNumber = 1;
        // }
        
        $lastNumber = count($lastBukti);
        $newNumber = $lastNumber + 1;
        $bukti = $bukti_prefix . $newNumber;
        return $bukti;
    }
    public function getAllRiwayatTransaksi(Request $request)
    {
        try {
            $id_lokasi = $request->id_lokasi;
            $id_barang = $request->id_barang;
            $data = $this->model->with(['lokasi', 'barang'])
                ->when($id_lokasi, function($q) use ($id_lokasi){
                    $q->where('id_lokasi', $id_lokasi);
                })
                ->when($id_barang, function($q) use ($id_barang) {
                    $q->where('id_barang', $id_barang);
                })
                ->get();
            if (!$data || $data->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 404,
                    'message' => 'Riwayat transaksi tidak ditemukan',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mendapatkan riwayat transaksi',
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
    // buat validasi input user pada buat transaksi
    private function validateInsert(Request $request)
    {
        return Validator::make($request->all(), 
        [
            'jenis_transaksi' => 'required|string|in:masuk,keluar',
            'bukti' => ' nullable|string|max:15',
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


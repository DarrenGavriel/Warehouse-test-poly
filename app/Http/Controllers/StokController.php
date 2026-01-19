<?php

namespace App\Http\Controllers;

use App\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Stok();
    }
    public function getAll()
    {
        try {
            $data = $this->model->infoStok();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil info stok',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil info stok',
            ], 500);
        }
    }    
    public function getTotalStok(Request $request)
    {
        try {
            $id_barang = $request->id_barang;
            $id_lokasi = $request->id_lokasi;
            $data = $this->model->totalStok($id_barang, $id_lokasi);
            if (!$data) {
                return response()->json([
                    'success' => false,
                    'http_status' => 404,
                    'message' => 'Data tidak ditemukan',
                ], 404);
            }
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
    public function getLaporanStok(Request $request)
    {
        try {
            $id_barang = $request->id_barang;
            $id_lokasi = $request->id_lokasi;
            $data = $this->model->laporanStok($id_barang, $id_lokasi);
            if (count($data) == 0) {
                return response()->json([
                    'success' => false,
                    'http_status' => 404,
                    'message' => 'Stok tidak ditemukan',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil laporan stok',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil laporan stok' . $e->getMessage(),
            ], 500);
        }
    }
}

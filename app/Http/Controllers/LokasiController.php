<?php

namespace App\Http\Controllers;

use App\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Lokasi();
    }
    public function getAll(Request $request)
    {
        try {
            if ($request->has('search') && $request->search != '') {
                $data_filtered = $this->model->where('nama_lokasi', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_lokasi', 'like', '%' . $request->search . '%')->limit(5)->get();
                if (count($data_filtered) == 0) {
                    return response()->json([
                        'success' => false,
                        'http_status' => 404,
                        'message' => 'Lokasi tidak ditemukan',
                    ], 404);
                }
                return response()->json([
                    'success' => true,
                    'http_status' => 200,
                    'message' => 'Berhasil mengambil lokasi',
                    'data' => $data_filtered
                ], 200);
            };
            $data = $this->model->all();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil lokasi',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil lokasi',
            ], 500);
        }
    }
}
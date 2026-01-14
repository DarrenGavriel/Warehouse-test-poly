<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BarangController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Barang();
    }
    public function getAll(Request $request): JsonResponse
    {
        try {
            if ($request->has('search') && $request->search != '') {
                $data_filtered = $this->model->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('kode_barang', 'like', '%' . $request->search . '%')->limit(5)->get();
                if (count($data_filtered) == 0) {
                    return response()->json([
                        'success' => false,
                        'http_status' => 404,
                        'message' => 'Barang tidak ditemukan',
                    ], 404);
                }
                return response()->json([
                    'success' => true,
                    'http_status' => 200,
                    'message' => 'Berhasil mengambil barang',
                    'data' => $data_filtered
                ], 200);
            }
            $data = $this->model->all();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil barang',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil barang',
            ], 500);
        }
    }
}

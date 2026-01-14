<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProgramController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Program();
    }
    public function getAll(Request $request): JsonResponse
    {
        try {
            if ($request->has('nama') && $request->nama != '') {
                $data_filtered = $this->model->where('nama_program', 'like', '%' . $request->nama . '%')->limit(5)->get();
                if (count($data_filtered) == 0) {
                    return response()->json([
                        'success' => false,
                        'http_status' => 404,
                        'message' => 'Program tidak ditemukan',
                    ], 404);
                }
                return response()->json([
                    'success' => true,
                    'http_status' => 200,
                    'message' => 'Berhasil mengambil program',
                    'data' => $data_filtered
                ], 200);
            }
            $data = $this->model->all();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil program',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil program',
            ], 500);
        }
    }
}

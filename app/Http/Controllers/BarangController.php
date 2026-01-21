<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            if ($request->master == 1) {
                if ($request->has('search') && $request->search != '') {
                    $data = $this->model->getBarang($request->search, $request->search)->paginate(10);
                    } else {
                        $data = $this->model->getBarang()->paginate(10);
                    }
                    if (count($data->items()) == 0) {
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
                        'data' => $data
                    ], 200);
            } else {
                if ($request->has('search') && $request->search != '') {
                    $data = $this->model->getBarang($request->search, $request->search)->limit(10)->get();
                } else {
                    $data = $this->model->getBarang()->get();
                }
                if (count($data) == 0) {
                    return response()->json([
                        'success' => false,
                        'http_status' => 404,
                        'message' => 'Barang tidak ditemukan',
                    ], 404);
                }
                return response()->json([
                    'success' => true,
                    'http_status' => 200,
                    'message' => 'berhasil mengambil barang',
                    'data' => $data
                ], 200);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil barang',
            ], 500);
        }
    }
    public function getById($id): JsonResponse
    {
        try {
            $data = $this->model->findOrFail($id);
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil barang',
                'data' => $data
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'http_status' => 404,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil barang',
            ], 500);
        }
    }
    public function insert(Request $request){
        try {
            $validator = $this->validateRequest($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Validasi gagal',
                    'data' => $validator->errors()
                ], 400);
            }
            $nama_barang = strtoupper($request->nama_barang);
            $kode_barang = strtoupper($request->kode_barang);
            $data = $this->model->create([
                'nama_barang' => $nama_barang,
                'kode_barang' => $kode_barang,
            ]);
            return response()->json([
                'success' => true,
                'http_status' => 201,
                'message' => 'Berhasil menambahkan barang',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'gagal menambahkan barang'
            ], 500);
        }
    }
    public function deleteBarang($id): JsonResponse
    {
        try {
            $data = $this->model->findOrFail($id);
            $data->delete();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'barang berhasil dihapus'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'http_status' => 404,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal menghapus barang',
            ], 500);
        }
    }
    public function updateBarang(Request $request, $id): JsonResponse
    {
        try {
            $validator = $this->validateRequest($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Validasi gagal',
                    'data' => $validator->errors()
                ], 400);
            }
            $data = $this->model->findOrFail($id);
            // $data->nama_barang = strtoupper($request->nama_barang);
            // $data->kode_barang = strtoupper($request->kode_barang);
            // $data->save();
            $nama_barang = strtoupper($request->nama_barang);
            $kode_barang = strtoupper($request->kode_barang);
            $data->update([
                'nama_barang' => $nama_barang,
                'kode_barang' => $kode_barang, 
            ]);
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil memperbarui barang',
                'data' => $data
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'http_status' => 404,
                'message' => 'Barang tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal memperbarui barang',
            ], 500);
        }
    }
    private function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:100|unique:barang,kode_barang',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi',
            'nama_barang.string' => 'Nama barang harus berupa kata',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter',
            'kode_barang.required' => 'Kode barang wajib diisi',
            'kode_barang.string' => 'Kode barang harus berupa kata',
            'kode_barang.max' => 'Kode barang maksimal 100 karakter',
            'kode_barang.unique' => 'Kode barang sudah digunakan',
        ]);
    }
    
}

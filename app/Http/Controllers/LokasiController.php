<?php

namespace App\Http\Controllers;

use App\Lokasi;
use App\RiwayatTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;

class LokasiController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Lokasi();
    }
    public function getAll(Request $request): JsonResponse 
    {
        try {
            if ($request->master == 1) {
                if ($request->has('search') && $request->search != '') {
                        $data = $this->model->getLokasi($request->search, $request->search)->paginate(10);
                    } else {
                        $data = $this->model->getLokasi()->paginate(10);
                    }
                    if (count($data->items()) == 0) {
                        return response()->json([
                            'success' => false,
                            'http_status' => 404,
                            'message' => 'Lokasi tidak ditemukan',
                        ], 404);
                    }
                    
                    // Tambahkan info apakah lokasi sudah digunakan di transaksi
                    $lokasiIds = $data->pluck('id')->toArray();
                    $usedLokasiIds = RiwayatTransaksi::whereIn('id_lokasi', $lokasiIds)
                        ->pluck('id_lokasi')
                        ->unique()
                        ->toArray();
                    
                    foreach ($data->items() as $lokasi) {
                        $lokasi->is_used = in_array($lokasi->id, $usedLokasiIds);
                    }
                    
                    return response()->json([
                        'success' => true,
                        'http_status' => 200,
                        'message' => 'Berhasil mengambil lokasi',
                        'data' => $data
                    ], 200);
            } else {
                    if ($request->has('search') && $request->search != '') {
                        $data = $this->model->getLokasi($request->search, $request->search)->limit(15)->get();
                        if (count($data) == 0) {
                            return response()->json([
                                'success' => false,
                                'http_status' => 404,
                                'message' => 'Lokasi tidak ditemukan',
                            ], 404);
                        } 
                    } else {
                        $data = $this->model->getLokasi()->limit(15)->get();
                    }
                    return response()->json([
                        'success' => true,
                        'http_status' => 200,
                        'message' => 'Berhasil mengambil lokasi',
                        'data' => $data
                    ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil lokasi' . $e->getMessage(),
            ], 500);
        }
    }
    public function createLokasi(Request $request): JsonResponse 
    {
        try {
            $validator = $this->validateRequest($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }
            $nama_lokasi = strtoupper($request->nama_lokasi);
            $kode_lokasi = strtoupper($request->kode_lokasi);
            $data = $this->model->create([
                'nama_lokasi' => $nama_lokasi,
                'kode_lokasi' => $kode_lokasi
            ]);
            return response()->json([
                'success' => true,
                'http_status' => 201,
                'message' => 'Berhasil menambahkan lokasi',
                'data' => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal menambahkan lokasi: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function deleteLokasi($id): JsonResponse 
    {
        try {
            $riwayat_transaksi = new RiwayatTransaksi();
            $cek_lokasi = $riwayat_transaksi->getLaporanTransaksi(null, null, null, $id);
            if (count($cek_lokasi) > 0) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Lokasi tidak dapat dihapus karena sudah dipakai untuk transaksi',
                ], 400);
            }
            $data = $this->model->findOrFail($id);
            $data->delete();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil menghapus lokasi',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'http_status' => 404,
                'message' => 'Lokasi tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal menghapus lokasi',
            ], 500);
        }
    }
    public function getLokasiById($id): JsonResponse 
    {
        try {
            $data = $this->model->findOrFail($id);
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil mengambil lokasi',
                'data' => $data
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'http_status' => 404,
                'message' => 'Lokasi tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal mengambil lokasi',
            ], 500);
        }
    }
    public function updateLokasi(Request $request, $id): JsonResponse 
    {
        try {
            $validator = $this->validateRequest($request);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'http_status' => 400,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }
            $data = $this->model->findOrFail($id);
            $data->nama_lokasi = strtoupper($request->nama_lokasi);
            $data->kode_lokasi = strtoupper($request->kode_lokasi);
            $data->save();
            return response()->json([
                'success' => true,
                'http_status' => 200,
                'message' => 'Berhasil memperbarui lokasi',
                'data' => $data
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'http_status' => 404,
                'message' => 'Lokasi tidak ditemukan',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'http_status' => 500,
                'message' => 'Gagal memperbarui lokasi: ' . $e->getMessage(),
            ], 500);
        }
    }
    private function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_lokasi' => 'required|string|max:100',
            'kode_lokasi' => 'required|string|max:50|unique:lokasi,kode_lokasi',
        ], [
            'nama_lokasi.required' => 'Nama lokasi wajib diisi',
            'nama_lokasi.string' => 'Nama lokasi harus berupa kata',
            'nama_lokasi.max' => 'Nama lokasi maksimal 100 karakter',
            'kode_lokasi.required' => 'Kode lokasi wajib diisi',
            'kode_lokasi.string' => 'Kode lokasi harus berupa string',
            'kode_lokasi.max' => 'Kode lokasi maksimal 50 karakter',
            'kode_lokasi.unique' => 'Kode lokasi sudah digunakan',
        ]);
    }
}
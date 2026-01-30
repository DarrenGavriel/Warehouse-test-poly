<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';
    protected $fillable = ['saldo', 'tanggal_masuk', 'id_barang', 'id_lokasi'];
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
    public function detailRiwayatTransaksi()
    {
        return $this->hasMany(DetailRiwayatTransaksi::class, 'id_detail_stok', 'id');
    }
    public function totalStok($id_barang = null, $id_lokasi = null)
    {
        $query = self::select('barang.kode_barang', 'barang.nama_barang', 'stok.id_lokasi')
            ->selectRaw('SUM(stok.saldo) as total_saldo, MAX(stok.tanggal_masuk) as terakhir_masuk')
            ->join('barang', 'stok.id_barang', '=', 'barang.id')
            ->when($id_barang, function ($query, $id_barang){
                return $query->where('barang.id', $id_barang);
            })
            ->when($id_lokasi, function ($query, $id_lokasi){
                return $query->where('stok.id_lokasi', $id_lokasi);
            })
            ->groupBy('barang.kode_barang', 'barang.nama_barang', 'stok.id_lokasi')
            ->first();
        return $query;
    }
    public function checkStok($id_barang, $id_lokasi)
    {
        $query = self::select([
            'tanggal_masuk',
            'id',
            'id_lokasi'
        ])
        ->selectRaw('sum(saldo) as saldo')
        ->where('id_barang', $id_barang)
        ->where('id_lokasi', $id_lokasi)
        ->groupBy('tanggal_masuk', 'id', 'id_lokasi')
        ->havingRaw('sum(saldo) != 0')
        ->orderBy('tanggal_masuk', 'asc')
        ->lockForUpdate()
        ->get();
        return $query;
    }
    public function laporanStok($id_barang = null, $id_lokasi = null)
    {
        $query = self::select('barang.kode_barang', 'barang.nama_barang', 'lokasi.kode_lokasi', 'stok.tanggal_masuk')
            ->selectRaw('SUM(stok.saldo) as total_saldo')
            ->join('barang', 'stok.id_barang', '=', 'barang.id')
            ->join('lokasi', 'stok.id_lokasi', '=', 'lokasi.id')
            
            ->when($id_barang, function ($query, $id_barang){
                return $query->where('barang.id', $id_barang);
            })
            ->when($id_lokasi, function ($query, $id_lokasi){
                return $query->where('lokasi.id', $id_lokasi);
            })
            ->groupBy('barang.kode_barang', 'lokasi.kode_lokasi', 'barang.nama_barang', 'stok.tanggal_masuk')
            ->havingRaw('SUM(stok.saldo) > 0')
            ->paginate(5);
        return $query;
    }
    public function laporanStok_dt($id_barang = null, $id_lokasi = null)
    {
        $query = self::select('barang.kode_barang', 'barang.nama_barang', 'lokasi.kode_lokasi', 'stok.tanggal_masuk')
            ->selectRaw('SUM(stok.saldo) as total_saldo')
            ->join('barang', 'stok.id_barang', '=', 'barang.id')
            ->join('lokasi', 'stok.id_lokasi', '=', 'lokasi.id')
            
            ->when($id_barang, function ($query, $id_barang){
                return $query->where('barang.id', $id_barang);
            })
            ->when($id_lokasi, function ($query, $id_lokasi){
                return $query->where('lokasi.id', $id_lokasi);
            })
            ->groupBy('barang.kode_barang', 'lokasi.kode_lokasi', 'barang.nama_barang', 'stok.tanggal_masuk')
            ->havingRaw('SUM(stok.saldo) > 0')
            ->get();
        return $query;
    }
}

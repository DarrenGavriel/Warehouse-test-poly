<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiwayatTransaksi extends Model
{
    protected $table = 'riwayat_transaksi';
    protected $fillable = ['waktu_transaksi', 'bukti', 'id_barang', 'id_lokasi', 'id_pengguna', 'id_program'];
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function detailRiwayatTransaksi()
    {
        return $this->hasMany(DetailRiwayatTransaksi::class, 'id_riwayat_transaksi', 'id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id');
    }
    public function getLaporanTransaksi($bukti = null, $tanggal_transaksi = null, $id_barang = null, $id_lokasi = null)
    {
        $query = $this::select([
            'bukti as bukti_transaksi',
            'lokasi.kode_lokasi as kode_lokasi',
            'barang.kode_barang as kode_barang',
            'program.nama_program as program'
        ])
        ->selectRaw('waktu_transaksi as tanggal_transaksi, 
                    SUM(detail_riwayat_transaksi.jumlah_transaksi) as total_transaksi,
                    DATE(stok.tanggal_masuk) as tanggal_masuk')
        ->join('lokasi', 'riwayat_transaksi.id_lokasi', '=', 'lokasi.id')
        ->join('barang', 'riwayat_transaksi.id_barang', '=', 'barang.id')
        ->join('detail_riwayat_transaksi', 'riwayat_transaksi.id', '=', 'detail_riwayat_transaksi.id_riwayat_transaksi')
        ->join('stok', 'detail_riwayat_transaksi.id_stok', '=', 'stok.id')
        ->join('program', 'riwayat_transaksi.id_program', '=', 'program.id')
        ->when($bukti, function ($query, $bukti) {
            return $query->where('bukti', 'like', '%' . $bukti . '%');
        })
        ->when($tanggal_transaksi, function ($query, $tanggal_transaksi){
            return $query->whereDate('waktu_transaksi', $tanggal_transaksi);
        })
        ->when($id_barang, function ($query, $id_barang){
            return $query->where('riwayat_transaksi.id_barang', $id_barang);
        })
        ->when($id_lokasi, function ($query, $id_lokasi){
            return $query->where('riwayat_transaksi.id_lokasi', $id_lokasi);
        })
        ->groupBy('bukti', 'lokasi.kode_lokasi', 'barang.kode_barang', 'waktu_transaksi', 'stok.tanggal_masuk', 'program.nama_program')
        // ->orderBy('lokasi.kode_lokasi', 'asc')
        ->paginate(10);
        return $query;
    }
}

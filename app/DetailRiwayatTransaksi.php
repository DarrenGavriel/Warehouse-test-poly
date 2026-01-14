<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRiwayatTransaksi extends Model
{
    protected $table = 'detail_riwayat_transaksi';
    protected $fillable = ['jumlah_transaksi', 'id_stok', 'id_riwayat_transaksi'];
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function Stok () 
    {
        return $this->belongsTo(Stok::class, 'id_stok', 'id');
    }
    public function riwayatTransaksi()
    {
        return $this->belongsTo(RiwayatTransaksi::class, 'id_riwayat_transaksi', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    protected $fillable = ['nama_lokasi','kode_lokasi'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    public function stok()
    {
        return $this->hasMany(Stok::class, 'id_lokasi', 'id');
    }
    public function riwayatTransaksi()
    {
        return $this->hasMany(RiwayatTransaksi::class, 'id_lokasi', 'id');
    }
}

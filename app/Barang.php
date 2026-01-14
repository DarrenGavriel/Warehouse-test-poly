<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama_barang', 'kode_barang'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    public function stok()
    {
        return $this->hasOne(Stok::class, 'id_barang', 'id');
    }
    public function riwayatTransaksi()
    {
        return $this->hasMany(RiwayatTransaksi::class, 'id_barang', 'id');
    }
}

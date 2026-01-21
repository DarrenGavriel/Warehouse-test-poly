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
    public function getBarang($kode_barang = null, $nama_barang = null)
    {
        $query = self::select('*')
            ->when($kode_barang, function ($query, $kode_barang){
                return $query->orWhere('kode_barang', 'like', '%' . $kode_barang . '%');
            })
            ->when($nama_barang, function ($query, $nama_barang){
                return $query->orWhere('nama_barang', 'like', '%' . $nama_barang . '%');
            });
        return $query;
    }
}

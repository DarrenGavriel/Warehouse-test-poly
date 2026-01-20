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
    public function getLokasi($kode_lokasi = null, $nama_lokasi = null)
    {
        $query = self::select('*')
            ->when($kode_lokasi, function ($query, $kode_lokasi){
                return $query->orWhere('kode_lokasi', 'like', '%' . $kode_lokasi . '%');
            })
            ->when($nama_lokasi, function ($query, $nama_lokasi){
                return $query->orWhere('nama_lokasi', 'like', '%' . $nama_lokasi . '%');
            });
        return $query;
    }
}

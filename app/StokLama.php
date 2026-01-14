<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';
    protected $fillable = ['id_barang'];
    protected $primaryKey = 'id_stok';
    public $timestamps = false;
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
    public function Stok()
    {
        return $this->hasMany(Stok::class, 'id_stok', 'id_stok');
    }

    public static function getAll()
    {
        $query = self::select('stok.id_stok', 'barang.nama_barang', 'stok.id_barang')
            ->join('barang', 'stok.id_barang', '=', 'barang.id_barang')->get();
        return $query;
    }
}

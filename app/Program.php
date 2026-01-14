<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $fillable = ['nama_program'];
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function riwayatTransaksi()
    {
        return $this->hasMany(RiwayatTransaksi::class, 'id_program', 'id');
    }
}

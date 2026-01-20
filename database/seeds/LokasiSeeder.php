<?php

use Illuminate\Database\Seeder;
use App\Lokasi;
class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lokasi::create(['nama_lokasi' => 'GEDUNG A', 'kode_lokasi' => 'GDG-A']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG B', 'kode_lokasi' => 'GDG-B']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG C', 'kode_lokasi' => 'GDG-C']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG D', 'kode_lokasi' => 'GDG-D']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG E', 'kode_lokasi' => 'GDG-E']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG F', 'kode_lokasi' => 'GDG-F']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG G', 'kode_lokasi' => 'GDG-G']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG H', 'kode_lokasi' => 'GDG-H']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG I', 'kode_lokasi' => 'GDG-I']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG J', 'kode_lokasi' => 'GDG-J']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG K', 'kode_lokasi' => 'GDG-K']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG L', 'kode_lokasi' => 'GDG-L']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG M', 'kode_lokasi' => 'GDG-M']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG N', 'kode_lokasi' => 'GDG-N']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG O', 'kode_lokasi' => 'GDG-O']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG P', 'kode_lokasi' => 'GDG-P']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG Q', 'kode_lokasi' => 'GDG-Q']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG R', 'kode_lokasi' => 'GDG-R']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG S', 'kode_lokasi' => 'GDG-S']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG T', 'kode_lokasi' => 'GDG-T']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG U', 'kode_lokasi' => 'GDG-U']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG V', 'kode_lokasi' => 'GDG-V']);
        Lokasi::create(['nama_lokasi' => 'GEDUNG W', 'kode_lokasi' => 'GDG-W']);
    }
}
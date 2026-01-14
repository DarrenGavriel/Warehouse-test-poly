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
        Lokasi::create(['nama_lokasi' => 'Gedung A', 'kode_lokasi' => 'GDG-A']);
        Lokasi::create(['nama_lokasi' => 'Gedung B', 'kode_lokasi' => 'GDG-B']);
        Lokasi::create(['nama_lokasi' => 'Gedung C', 'kode_lokasi' => 'GDG-C']);
        Lokasi::create(['nama_lokasi' => 'Gedung D', 'kode_lokasi' => 'GDG-D']);
    }
}   

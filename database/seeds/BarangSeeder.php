<?php

use Illuminate\Database\Seeder;
use App\Barang;
class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create(['nama_barang' => 'Barang 1', 'kode_barang' => 'BRG1']);
        Barang::create(['nama_barang' => 'Barang 2', 'kode_barang' => 'BRG2']);
        Barang::create(['nama_barang' => 'Barang 3', 'kode_barang' => 'BRG3']);
        Barang::create(['nama_barang' => 'Barang 4', 'kode_barang' => 'BRG4']);
    }
}

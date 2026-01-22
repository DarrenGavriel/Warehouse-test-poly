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
        Barang::create(['nama_barang' => 'BARANG 1', 'kode_barang' => 'BRG1']);
        Barang::create(['nama_barang' => 'BARANG 2', 'kode_barang' => 'BRG2']);
        Barang::create(['nama_barang' => 'BARANG 3', 'kode_barang' => 'BRG3']);
        Barang::create(['nama_barang' => 'BARANG 4', 'kode_barang' => 'BRG4']);
        Barang::create(['nama_barang' => 'BARANG 5', 'kode_barang' => 'BRG5']);
        Barang::create(['nama_barang' => 'BARANG 6', 'kode_barang' => 'BRG6']);
        Barang::create(['nama_barang' => 'TV Polytron', 'kode_barang' => 'PSA2001']);
        Barang::create(['nama_barang' => 'TV Sharp', 'kode_barang' => 'SSA2001']);
        Barang::create(['nama_barang' => 'Radio Sharp', 'kode_barang' => 'SSA2002']);
        Barang::create(['nama_barang' => 'Radio Polytron', 'kode_barang' => 'PSA2002']);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Stok;
class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stok::create([
            'saldo' => 100,
            'tanggal_masuk' => '2024-01-15',
            'id_barang' => '1',
            'id_lokasi' => '1',
        ]);
        Stok::create([
            'saldo' => 50,
            'tanggal_masuk' => '2024-02-20',
            'id_barang' => '1',
            'id_lokasi' => '1',
        ]);
        Stok::create([
            'saldo' => 40,
            'tanggal_masuk' => '2024-03-10',
            'id_barang' => '1',
            'id_lokasi' => '2',
        ]);
        Stok::create([
            'saldo' => 50,
            'tanggal_masuk' => '2024-04-05',
            'id_barang' => '2',
            'id_lokasi' => '2',
        ]);
        Stok::create([
            'saldo' => 30,
            'tanggal_masuk' => '2024-05-12',
            'id_barang' => '2',
            'id_lokasi' => '1',
        ]);
        Stok::create([
            'saldo' => 80,
            'tanggal_masuk' => '2024-06-18',
            'id_barang' => '3',
            'id_lokasi' => '3',
        ]);
        Stok::create([
            'saldo' => 60,
            'tanggal_masuk' => '2024-07-22',
            'id_barang' => '3',
            'id_lokasi' => '3',
        ]);
        Stok::create([
            'saldo' => 90,
            'tanggal_masuk' => '2024-08-30',
            'id_barang' => '4',
            'id_lokasi' => '1',
        ]);
        Stok::create([
            'saldo' => 70,
            'tanggal_masuk' => '2024-09-14',
            'id_barang' => '4',
            'id_lokasi' => '1',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\DetailRiwayatTransaksi;
class DetailRiwayatTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailRiwayatTransaksi::create([
            'jumlah_transaksi'=> 10,
            'id_stok'=> 1,
            'id_riwayat_transaksi'=> 1
        ]);
        DetailRiwayatTransaksi::create([
            'jumlah_transaksi'=> 40,
            'id_stok'=> 1,
            'id_riwayat_transaksi'=> 1
        ]);
        DetailRiwayatTransaksi::create([
            'jumlah_transaksi'=> 20,
            'id_stok'=> 2,
            'id_riwayat_transaksi'=> 2
        ]);
        DetailRiwayatTransaksi::create([
            'jumlah_transaksi'=> 30,
            'id_stok'=> 3,
            'id_riwayat_transaksi'=> 2
        ]);
        DetailRiwayatTransaksi::create([
            'jumlah_transaksi'=> 15,
            'id_stok'=> 3,
            'id_riwayat_transaksi'=> 3
        ]);
    }
}

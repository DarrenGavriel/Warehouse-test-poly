<?php

use Illuminate\Database\Seeder;
use App\RiwayatTransaksi;
class RiwayatTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RiwayatTransaksi::create([
            'waktu_transaksi' => '2025-12-01 09:00:00',
            'bukti' => 'BKT001',
            'id_lokasi' => '1',
            'id_barang' => '1',
            'id_program' => 1,
        ]);
        RiwayatTransaksi::create([
            'waktu_transaksi' => '2025-12-01 10:00:00',
            'bukti' => 'BKT002',
            'id_lokasi' => '2',
            'id_barang' => '2',
            'id_program' => 2,
        ]);
        RiwayatTransaksi::create([
            'waktu_transaksi' => '2025-12-01 11:00:00',
            'bukti' => 'BKT003',
            'id_lokasi' => '3',
            'id_barang' => '3',
            'id_program' => 3,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ProgramSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(LokasiSeeder::class);
        $this->call(StokSeeder::class);
        // $this->call(StokSeeder::class);
        $this->call(RiwayatTransaksiSeeder::class);
        $this->call(DetailRiwayatTransaksiSeeder::class);
    }
}

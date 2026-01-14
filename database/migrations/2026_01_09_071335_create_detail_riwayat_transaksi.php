<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailRiwayatTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_riwayat_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jumlah_transaksi');
            $table->unsignedBigInteger('id_riwayat_transaksi');
            $table->unsignedBigInteger('id_stok');
            $table->foreign('id_riwayat_transaksi')->references('id')->on('riwayat_transaksi')->onDelete('cascade');
            $table->foreign('id_stok')->references('id')->on('stok')->onDelete('cascade');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_history_transaksi');
    }
}

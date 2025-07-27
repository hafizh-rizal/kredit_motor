<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_kredit', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengajuan_kredit');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_motor');
            $table->double('harga_cash');
            $table->integer('dp');
            $table->unsignedBigInteger('id_jenis_cicilan');
            $table->double('harga_kredit');
            $table->unsignedBigInteger('id_asuransi');
            $table->double('biaya_asuransi')->nullable();
            $table->double('cicilan_perbulan');
            $table->string('url_kk', 255)->nullable();
            $table->string('url_ktp', 255)->nullable();
            $table->string('url_npwp', 255)->nullable();
            $table->string('url_slip_gaji', 255)->nullable();
            $table->string('url_foto', 255)->nullable();
            $table->enum('status_pengajuan', ['Menunggu Konfirmasi', 'Diproses', 'Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah', 'Diterima']);
            $table->string('keterangan_status_pengajuan', 255)->nullable();
             $table->enum('alamat_pengiriman', ['alamat1', 'alamat2', 'alamat3']);
            $table->timestamps();

            $table->foreign('id_motor')->references('id')->on('motor');
            $table->foreign('id_jenis_cicilan')->references('id')->on('jenis_cicilan');
            $table->foreign('id_asuransi')->references('id')->on('asuransi');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_kredit');
    }
};

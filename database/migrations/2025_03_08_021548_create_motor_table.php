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
        Schema::create('motor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_motor', 100);
            $table->unsignedBigInteger('id_jenis_motor');
            $table->integer('harga_jual');
            $table->text('deskripsi_motor')->nullable();
            $table->string('warna', 50);
            $table->string('kapasitas_mesin', 10);
            $table->string('url_produksi', 255)->nullable();
            $table->string('foto1', 255)->nullable();
            $table->string('foto2', 255)->nullable();
            $table->string('foto3', 255)->nullable();
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('id_jenis_motor')->references('id')->on('jenis_motor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};

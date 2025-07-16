<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->string('nama_aplikasi');
        $table->string('versi')->nullable();
        $table->date('masa_berlaku')->nullable();
        $table->string('status')->nullable(); // Aktif / Non-Aktif
        $table->string('harga')->nullable();
        $table->date('tanggal_pembelian')->nullable();
        $table->string('lokasi_pembelian')->nullable(); // E-Commerce / Official
        $table->text('deskripsi')->nullable();
        $table->string('bukti_pembelian')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};

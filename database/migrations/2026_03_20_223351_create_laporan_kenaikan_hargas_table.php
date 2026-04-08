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
        Schema::create('laporan_kenaikan_hargas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi');
            $table->string('nomor_batch');
            $table->string('nomor_sku');
            $table->integer('harga_lama');
            $table->integer('harga_beli');
            $table->integer('kenaikan_hara');
            $table->integer('jumlah_harga');
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kenaikan_hargas');
    }
};
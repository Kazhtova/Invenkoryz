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
        Schema::create('kartu_stoks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi')->nullable();
            $table->enum('jenis_transaksi', ['in', 'out', 'adjustment', 'retur']);
            $table->string('nomor_sku');
            $table->integer('jumlah_masuk')->nullable();
            $table->integer('jumlah_keluar')->nullable();
            $table->integer('stok_akhir');
            $table->string('petugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_stoks');
    }
};
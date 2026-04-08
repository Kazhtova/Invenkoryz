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
        Schema::create('transaksi_retur_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_retur_id')->nullable()->constrained('transaksi_returs')->cascadeOnDelete();
            $table->string('produk');
            $table->string('nomor_sku');
            $table->string('nomor_batch');
            $table->string('varian');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('sub_total');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_retur_items');
    }
};
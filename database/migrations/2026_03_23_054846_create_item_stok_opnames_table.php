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
        Schema::create('item_stok_opnames', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_stok_opname_id')->nullable()->constrained('periode_stok_opnames')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nomor_sku');
            $table->integer('jumlah_stok')->nullable();
            $table->integer('jumlah_dilaporkan')->nullable();
            $table->enum('status', ['sesuai', 'selisih', 'belum dilaporkan'])->default('belum dilaporkan');
            $table->string('keterangan')->nullable();
            $table->string('petugas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stok_opnames');
    }
};
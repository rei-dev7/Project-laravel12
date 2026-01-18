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
        Schema::create('kategori_tujuan', function (Blueprint $table) {
            $table->id('id_kategori_tujuan'); // Primary Key
            $table->string('nama_tujuan', 100)->unique(); // Nama tujuan (Contoh: Penjualan Ritel)
            $table->string('tipe', 50); // Tipe untuk pengelompokan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_tujuan');
    }
};
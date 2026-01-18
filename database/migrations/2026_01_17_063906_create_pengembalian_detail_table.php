<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pengembalian_detail', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel induk 'pengembalian'
        $table->unsignedBigInteger('id_pengembalian');
        // Menghubungkan ke tabel 'item'
        $table->unsignedBigInteger('id_item');
        // Jumlah barang yang dikembalikan saat itu
        $table->integer('jumlah');
        $table->timestamps();

        // Definisi Foreign Key (Sesuaikan nama kolom ID pada tabel asal Anda)
        $table->foreign('id_pengembalian')->references('id')->on('pengembalian')->onDelete('cascade');
        $table->foreign('id_item')->references('id_item')->on('item')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_detail');
    }
};

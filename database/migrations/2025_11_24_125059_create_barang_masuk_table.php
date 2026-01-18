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
        // ...
Schema::create('barang_masuk', function (Blueprint $table) {
    $table->id('id_masuk'); // Primary Key

    // Foreign Keys
    $table->foreignId('id_item')->constrained('item', 'id_item')->onDelete('cascade');
    $table->foreignId('id_supplier')->constrained('supplier', 'id_supplier')->onDelete('restrict');
    // Asumsi tabel User bawaan Laravel menggunakan PK 'id'
    // Pastikan ada parameter kedua 'id_user' di constrained()
$table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('restrict');
    $table->integer('jumlah');
    $table->integer('jumlah_stok'); // Stok setelah barang masuk (mungkin tidak perlu di sini, tapi mengikuti ERD)
    $table->dateTime('tanggal_masuk');
    $table->string('keterangan', 255)->nullable();
    $table->timestamps();
});
// ...
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};

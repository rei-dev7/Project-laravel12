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
Schema::create('item', function (Blueprint $table) {
    $table->id('id_item'); // Primary Key
    
    // Foreign Key ke Sub Kategori
    $table->foreignId('id_sub_kategori')->constrained('sub_kategori', 'id_sub_kategori')->onDelete('restrict');
    
    $table->string('kode_item', 255)->unique(); // Asumsi kode item harus unik
    $table->string('nama_item', 255);
    $table->string('satuan', 255);
    $table->integer('jumlah_stok')->default(0);
    $table->timestamps();
});
// ...
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

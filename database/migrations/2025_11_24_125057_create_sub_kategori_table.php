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
Schema::create('sub_kategori', function (Blueprint $table) {
    $table->id('id_sub_kategori'); // Primary Key
    
    // Foreign Key ke Kategori
    $table->foreignId('id_kategori')->constrained('kategori', 'id_kategori')->onDelete('cascade');
    
    $table->string('nama_sub_kategori', 255);
    $table->timestamps();
});
// ...
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kategoris');
    }
};

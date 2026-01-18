<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_peminjaman')
                  ->constrained('peminjaman', 'id_peminjaman')
                  ->cascadeOnDelete();

            $table->foreignId('id_item')
                  ->constrained('item', 'id_item');

            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_detail');
    }
};


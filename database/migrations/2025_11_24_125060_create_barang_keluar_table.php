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
        // Asumsi tabel barang_keluar sudah ada
        Schema::table('barang_keluar', function (Blueprint $table) {
            
            // 1. Tambahkan Foreign Key baru 
            $table->unsignedBigInteger('id_kategori_tujuan')->nullable()->after('id_user');
            
            // 2. Tambahkan Foreign Key constraint
            $table->foreign('id_kategori_tujuan')
                  ->references('id_kategori_tujuan')
                  ->on('kategori_tujuan')
                  ->onDelete('set null'); // Jika kategori tujuan dihapus, kolom ini diset null.

            // 3. Hapus kolom tujuan_keluar yang lama (yang berupa string)
            // Cek dulu apakah kolomnya ada sebelum dihapus untuk menghindari error.
            if (Schema::hasColumn('barang_keluar', 'tujuan_keluar')) {
                $table->dropColumn('tujuan_keluar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            // 1. Hapus Foreign Key constraint dan kolom
            $table->dropForeign(['id_kategori_tujuan']);
            $table->dropColumn('id_kategori_tujuan');

            // 2. Kembalikan kolom tujuan_keluar (string) 
            $table->string('tujuan_keluar', 255)->nullable();
        });
    }
};
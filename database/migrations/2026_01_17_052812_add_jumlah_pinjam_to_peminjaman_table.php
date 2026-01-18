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
    Schema::table('peminjaman', function (Blueprint $table) {
        // Menambahkan kolom jumlah_pinjam setelah kolom peminjam
        $table->integer('jumlah_pinjam')->default(0)->after('peminjam');
    });
}

public function down()
{
    Schema::table('peminjaman', function (Blueprint $table) {
        $table->dropColumn('jumlah_pinjam');
    });
}
};

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
Schema::create('supplier', function (Blueprint $table) {
    $table->id('id_supplier'); // Primary Key
    $table->string('nama_supplier', 255);
    $table->string('telepon', 255)->nullable();
    $table->text('alamat')->nullable();
    $table->timestamps();
});
// ...
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

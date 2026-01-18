<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';
    protected $primaryKey = 'id_sub_kategori';
    protected $guarded = []; // Mengizinkan mass assignment untuk semua field kecuali yang dijaga

    /**
     * Relasi: SubKategori dimiliki oleh satu Kategori (many-to-one).
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
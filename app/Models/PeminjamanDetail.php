<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PeminjamanDetail extends Model

{
protected $table = 'peminjaman_detail'; 
public $incrementing = false; // Jika tidak ada kolom 'id' yang auto-increment
protected $primaryKey = null; // Jika menggunakan composite key
protected $fillable = [
    'id_peminjaman',
    'id_item',
    'jumlah'
];
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
}

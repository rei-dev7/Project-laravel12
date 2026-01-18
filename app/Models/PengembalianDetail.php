<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengembalianDetail extends Model
{
    // Jika nama tabel Anda 'pengembalian_detail', 
    // Laravel (yang biasanya bahasa Inggris) perlu diberi tahu nama tabelnya secara manual
    protected $table = 'pengembalian_detail';

    protected $fillable = [
        'id_pengembalian',
        'id_item',
        'jumlah'
    ];

    // Relasi ke Item
    public function item()
{
    return $this->belongsTo(Item::class, 'id_item', 'id_item');
}
}
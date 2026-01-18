<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';
    
    protected $fillable = [
        'id_item',
        'id_supplier',
        'jumlah_stok',
        'tanggal_masuk',
        'id_user',
    ];

    /**
     * Relasi ke Item
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    /**
     * Relasi ke Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }

    /**
     * Relasi ke User (pencatat)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
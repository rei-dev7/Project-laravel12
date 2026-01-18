<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';

    protected $fillable = [
        'id_item',
        'jumlah', // Ubah dari 'kuantitas' menjadi 'jumlah' sesuai database
        'tanggal_keluar',
        'id_user',
        'id_kategori_tujuan',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id_item');
    }

    public function kategoriTujuan()
    {
        return $this->belongsTo(KategoriTujuan::class, 'id_kategori_tujuan', 'id_kategori_tujuan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
    
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kategori'; 

    // Primary Key tabel
    protected $primaryKey = 'id_kategori'; 

    // Menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false; 

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'nama_kategori',
    ];
    

    // Override fungsi Route Key Name untuk Route Model Binding
    public function getRouteKeyName()
    {
        return 'id_kategori';
    }
    public function item()
{
    return $this->hasMany(Item::class, 'id_kategori', 'id_kategori');
}

}
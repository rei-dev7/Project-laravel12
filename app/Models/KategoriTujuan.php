<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriTujuan extends Model
{
    use HasFactory;
    protected $table = 'kategori_tujuan'; 
    protected $primaryKey = 'id_kategori_tujuan'; 
    protected $fillable = ['nama_tujuan','tipe'];

    // Relasi: Kategori Tujuan memiliki banyak Barang Keluar
    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'id_kategori_tujuan', 'id_kategori_tujuan');
    }
}
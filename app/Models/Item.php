<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item'; 
    protected $primaryKey = 'id_item'; 

    protected $fillable = [
        'id_kategori',       // ← WAJIB ADA
        'id_sub_kategori',
        'kode_item',
        'nama_item',
        'satuan',
        'jumlah_stok'
    ];

    public function subKategori()
    {
        return $this->belongsTo(SubKategori::class, 'id_sub_kategori');
    }

    public function barangMasuks()
    {
        return $this->hasMany(BarangMasuk::class, 'id_item', 'id_item');
    }

    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class, 'id_item', 'id_item');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}

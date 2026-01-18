<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pengembalian extends Model
{

 protected $table = 'pengembalian'; // Pastikan nama tabel benar
protected $primaryKey = 'id';
// public $incrementing = false; 
protected $fillable = [
    'id_peminjaman',
    'tanggal_kembali',
    'kondisi',  // Tambahkan ini
    'catatan'   // Tambahkan ini
];

// DEFINISIKAN RELASI INI
    public function peminjaman()
    {
        // Pengembalian "Milik" Peminjaman
        // Parameter: (NamaModel, foreign_key, owner_key)
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }

    public function detail()
    {
        return $this->hasMany(PengembalianDetail::class, 'id_pengembalian','id');
    }
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'kode_peminjaman',
        'peminjam',
        'jumlah_pinjam',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'status',
        'keterangan',
    ];

    public function user(): BelongsTo
    {
        // Pastikan 'id_user' adalah nama kolom di tabel peminjaman
        return $this->belongsTo(User::class, 'id_user');
    }
    public function pengembalian()
{
    // Peminjaman "Memiliki Satu" Pengembalian
    return $this->hasOne(Pengembalian::class, 'id_peminjaman', 'id_peminjaman');
}

    // ✅ RELASI KE DETAIL
    public function detail()
    {
        return $this->hasMany(
            PeminjamanDetail::class,
            'id_peminjaman',
            'id_peminjaman'
        );
    }

}

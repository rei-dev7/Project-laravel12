<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PengembalianDetail;
use App\Models\PeminjamanDetail;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjaman')->orderBy('created_at', 'desc')->get();
        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create(Peminjaman $peminjaman)
    {
        $peminjaman->load('detail.item');
        return view('pengembalian.create', compact('peminjaman'));
    }

   public function store(Request $request, Peminjaman $peminjaman)
{
    // 1. Validasi Input
    $request->validate([
        'items' => 'required|array',
        'kondisi' => 'required',
        'tanggal_kembali' => 'required|date',
    ]);

    $idPeminjaman = $peminjaman->id_peminjaman ?? $peminjaman->id;

    if (!$idPeminjaman) {
        return back()->with('error', 'ID Peminjaman tidak terdeteksi.');
    }

    DB::beginTransaction();
    try {
        // 2. Simpan ke tabel pengembalian
        $pengembalian = Pengembalian::create([
    'id_peminjaman'   => $idPeminjaman,
    'tanggal_kembali' => $request->tanggal_kembali,
    'kondisi'         => $request->kondisi,
    'catatan'         => $request->catatan,
]);

        // 3. Looping Barang
        foreach ($request->items as $id_item => $data) {
            $jumlah_kembali = (int) $data['jumlah'];
            
            if ($jumlah_kembali <= 0) continue;

            $detail = DB::table('peminjaman_detail')
                ->where('id_peminjaman', $idPeminjaman)
                ->where('id_item', $id_item)
                ->first();

            if ($detail) {
                // Simpan ke pengembalian_detail
                PengembalianDetail::create([
    'id_pengembalian' => $pengembalian->id, // ← Ambil dari kolom id
    'id_item' => $id_item,
    'jumlah' => $jumlah_kembali,
]);

                // Update stok jika kondisi baik
                if ($request->kondisi == 'baik') {
                    DB::table('item')
                        ->where('id_item', $id_item)
                        ->increment('jumlah_stok', $jumlah_kembali);
                }

                // Kurangi peminjaman_detail
                DB::table('peminjaman_detail')
                    ->where('id_peminjaman', $idPeminjaman)
                    ->where('id_item', $id_item)
                    ->decrement('jumlah', $jumlah_kembali);
            }
        }

        // 4. Update status peminjaman
        $this->updateStatusPeminjaman($peminjaman);

        DB::commit();
        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian Berhasil Disimpan!');

    } catch (\Exception $e) {
        DB::rollBack();
        dd('Error: ' . $e->getMessage()); // ← Tambahkan ini untuk lihat error
        return back()->with('error', 'Gagal: ' . $e->getMessage());
    }
}

public function show($id)
{
    // Cari berdasarkan id_peminjaman karena URL pakai id_peminjaman
    $pengembalian = Pengembalian::where('id_peminjaman', $id)
        ->with(['peminjaman', 'detail.item'])
        ->firstOrFail();
    
    return view('pengembalian.show', compact('pengembalian'));
}


    // Fungsi tambahan jika Anda menggunakan sistem pengembalian sebagian
    private function updateStatusPeminjaman($peminjaman)
    {
        // Ambil ID yang benar
        $idPeminjaman = $peminjaman->id_peminjaman ?? $peminjaman->id;

        // Hitung sisa barang yang masih memiliki jumlah > 0 di tabel detail
        $totalSisaBarang = DB::table('peminjaman_detail')
            ->where('id_peminjaman', $idPeminjaman)
            ->sum('jumlah');

        // Jika sisa jumlah semua barang adalah 0, berarti sudah kembali semua
        if ($totalSisaBarang <= 0) {
            $peminjaman->status = 'dikembalikan';
        } else {
            $peminjaman->status = 'dikembalikan_sebagian';
        }

        $peminjaman->save();

        }

        public function laporanCetak()
{
    $pengembalian = Pengembalian::with([
        'peminjaman',
        'detail.item'
    ])->orderBy('tanggal_kembali', 'desc')->get();
    
    return view('pengembalian.laporan-cetak', compact('pengembalian'));
}
}

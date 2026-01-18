<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{

public function index()
{
    // Ambil data peminjaman + detail + item
    $peminjaman = Peminjaman::with(['detail.item'])
        ->orderBy('tanggal_pinjam', 'desc')
        ->get();

    return view('peminjaman.index', compact('peminjaman'));
}
public function create()
{
    $item = Item::orderBy('nama_item', 'asc')->get();

    return view('peminjaman.create', compact('item'));
}


public function store(Request $request)
{
    $request->validate([
        'peminjam' => 'required|string|max:100',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        'item' => 'required|array',
    ]);

    try {
        DB::transaction(function () use ($request) {
            
            // 1. Hitung total jumlah dari semua item yang diinput
            // array_sum akan menjumlahkan semua value dalam array item [id_item => jumlah]
            $totalJumlahPinjam = array_sum($request->item);

            // 2. Simpan ke tabel Peminjaman termasuk kolom jumlah_pinjam
            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => 'PMJ-' . now()->format('YmdHis'),
                'peminjam' => $request->peminjam,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
                'jumlah_pinjam' => $totalJumlahPinjam, // Masuk ke tabel peminjaman
                'status' => 'dipinjam',
                'keterangan' => $request->keterangan,
            ]);

            // 3. Loop untuk detail dan kurangi stok
            foreach ($request->item as $id_item => $jumlah) {

                if ($jumlah <= 0) continue;

                $item = Item::lockForUpdate()->findOrFail($id_item);

                if ($item->jumlah_stok < $jumlah) {
                    throw new \Exception("Stok {$item->nama_item} tidak mencukupi");
                }

                // kurangi stok
                $item->decrement('jumlah_stok', $jumlah);

                // simpan ke tabel peminjaman_detail
                PeminjamanDetail::create([
                    'id_peminjaman' => $peminjaman->id_peminjaman,
                    'id_item' => $item->id_item,
                    'jumlah' => $jumlah,
                ]);
            }
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil disimpan');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal menyimpan peminjaman: ' . $e->getMessage());
    }
}

public function laporan()
{
    // Mengambil data peminjaman beserta detail barang dan user yang memproses
    $peminjaman = Peminjaman::with(['detail.item'])
        ->orderBy('tanggal_pinjam', 'desc')
        ->get();

    return view('peminjaman.laporan', compact('peminjaman'));
}


}

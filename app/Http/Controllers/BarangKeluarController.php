<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Item;
use App\Models\KategoriTujuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    public function index()
{
    $barangKeluar = BarangKeluar::with(['item'])
        ->latest()
        ->get();

    return view('barangkeluar.index', [
        'barangKeluar' => $barangKeluar
    ]);
}
    public function create()
    {
        $user = User::find(1); 
        return view('barangkeluar.create', [
            'item' => Item::where('jumlah_stok', '>', 0)->get(),
            'kategoriTujuan' => KategoriTujuan::all(),
            'user' => $user
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'id_item' => 'required|exists:item,id_item',
        'id_kategori_tujuan' => 'required',
        'kuantitas' => 'required|integer|min:1',
        'tanggal_keluar' => 'required|date',
    ]);

    $item = Item::where('id_item', $request->id_item)->first();

    if (!$item) {
        return back()->with('error', 'Item tidak ditemukan');
    }

    if ($request->kuantitas > $item->jumlah_stok) {
        return back()->with('error', 'Stok tidak mencukupi');
    }

    // SIMPAN BARANG KELUAR
    BarangKeluar::create([
        'id_item' => $request->id_item,
        'id_user' => Auth::id(), // user default
        'id_kategori_tujuan' => $request->id_kategori_tujuan,
        'jumlah' => $request->kuantitas,
        'tanggal_keluar' => $request->tanggal_keluar,
    ]);

    // ⬇⬇⬇ INI KUNCI UTAMA ⬇⬇⬇
    Item::where('id_item', $request->id_item)
        ->decrement('jumlah_stok', $request->kuantitas);

    return redirect()->route('barangkeluar.index')
        ->with('success', 'Barang keluar berhasil & stok berkurang');
}

public function edit($id)
{
    $barangKeluar = BarangKeluar::findOrFail($id);

    return view('barangkeluar.edit', [
        'barangKeluar'   => $barangKeluar,
        'item'           => Item::all(),
        'kategoriTujuan' => KategoriTujuan::all(),
        'user'           => User::find(1), // user default
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'id_item' => 'required|exists:item,id_item',
        'id_kategori_tujuan' => 'required',
        'jumlah' => 'required|integer|min:1',
        'tanggal_keluar' => 'required|date',
    ]);

    try {
        DB::transaction(function () use ($request, $id) {

            $barangKeluar = BarangKeluar::findOrFail($id);

            // 1️⃣ Kembalikan stok lama
            $itemLama = Item::findOrFail($barangKeluar->id_item);
            $itemLama->increment('jumlah_stok', $barangKeluar->jumlah);

            // 2️⃣ Ambil item baru
            $itemBaru = Item::findOrFail($request->id_item);

            // 3️⃣ Cek stok
            if ($request->jumlah > $itemBaru->jumlah_stok) {
                throw new \Exception('Stok tidak mencukupi');
            }

            // 4️⃣ Update barang keluar
            $barangKeluar->update([
                'id_item' => $request->id_item,
                'id_kategori_tujuan' => $request->id_kategori_tujuan,
                'jumlah' => $request->jumlah,
                'tanggal_keluar' => $request->tanggal_keluar,
                'id_user' => 1,
            ]);

            // 5️⃣ Kurangi stok baru
            $itemBaru->decrement('jumlah_stok', $request->jumlah);
        });

        return redirect()->route('barangkeluar.index')
            ->with('success', 'Data barang keluar berhasil diperbarui');

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage());
    }
}



public function destroy($id)
{
    DB::transaction(function () use ($id) {

        $barangKeluar = BarangKeluar::findOrFail($id);
        $item = Item::findOrFail($barangKeluar->id_item);

        // Kembalikan stok
        $item->increment('jumlah_stok', $barangKeluar->jumlah);

        // Hapus transaksi
        $barangKeluar->delete();
    });

    return redirect()->route('barangkeluar.index')
        ->with('success', 'Transaksi barang keluar dihapus & stok dikembalikan');
}

public function laporan()
{
    // Mengambil semua data barang keluar beserta relasinya
    $barangKeluar = \App\Models\BarangKeluar::with(['item', 'user'])
        ->orderBy('tanggal_keluar', 'desc')
        ->get();

    return view('barangkeluar.laporan', compact('barangKeluar'));
}
}
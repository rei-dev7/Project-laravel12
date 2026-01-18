<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with(['item', 'supplier', 'user'])
                                  ->orderBy('tanggal_masuk', 'desc')
                                  ->get();
        return view('barangmasuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $items = Item::orderBy('nama_item')->get();
        $suppliers = Supplier::orderBy('nama_supplier')->get();
        return view('barangmasuk.create', compact('items', 'suppliers'));
    }

   public function store(Request $request)
{
    $request->validate([
        'id_item' => 'required|exists:item,id_item',
        'jumlah_stok' => 'required|numeric|min:1',
        'tanggal_masuk' => 'required|date',
        'id_supplier' => 'required|exists:supplier,id_supplier',
    ]);

    try {
        DB::transaction(function () use ($request) {

            // 1️⃣ Simpan ke tabel barang_masuk
            BarangMasuk::create([
                'id_item'       => $request->id_item,
                'jumlah_stok'   => $request->jumlah_stok,
                'tanggal_masuk' => $request->tanggal_masuk,
                'id_supplier'   => $request->id_supplier,
                'id_user' => Auth::id(), // paten admin
            ]);

            // 2️⃣ Tambah stok di tabel item
            $item = Item::findOrFail($request->id_item);
            $item->jumlah_stok += $request->jumlah_stok;
            $item->save();
        });

        return redirect()->route('barangmasuk.index')
            ->with('success', 'Barang masuk berhasil disimpan dan stok bertambah');

    } catch (\Exception $e) {
        return back()->withInput()
            ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
    }
}


public function destroy($id)
{
    try {
        DB::transaction(function () use ($id) {

            $barangMasuk = BarangMasuk::findOrFail($id);
            $item = Item::findOrFail($barangMasuk->id_item);

            // 🔴 LOGIKA ERROR (seperti line 75)
            if ($item->jumlah_stok < $barangMasuk->jumlah_stok) {
                throw new \Exception(
                    'Transaksi tidak bisa dihapus karena stok sudah terpakai.'
                );
            }

            // Kurangi stok
            $item->jumlah_stok -= $barangMasuk->jumlah_stok;
            $item->save();

            // Hapus transaksi
            $barangMasuk->delete();
        });

        return redirect()->route('barangmasuk.index')
            ->with('success', 'Transaksi berhasil dihapus dan stok dikoreksi');

    } catch (\Exception $e) {
        // ✅ ERROR HANYA DI INDEX
        return redirect()->route('barangmasuk.index')
            ->with('error', $e->getMessage());
    }
}

public function edit($id)
    {
        // Mencari data barang masuk berdasarkan ID
        $barangMasuk = BarangMasuk::findOrFail($id);
        
        // Mengambil data pendukung untuk dropdown
        $items = Item::all();
        $suppliers = Supplier::all();

        return view('barangmasuk.edit', compact('barangMasuk', 'items', 'suppliers'));
    }

    /**
     * Memperbarui data barang masuk di database.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'tanggal_masuk' => 'required|date',
        'id_item'       => 'required|exists:item,id_item',
        'id_supplier'   => 'required|exists:supplier,id_supplier',
        'jumlah_stok'   => 'required|integer|min:1',
    ]);

    try {
        DB::beginTransaction();

        $barangmasuk = BarangMasuk::findOrFail($id);
        $itemLama = Item::findOrFail($barangmasuk->id_item);

        // 🔴 VALIDASI LINE 75 (stok lama)
        if ($itemLama->jumlah_stok < $barangmasuk->jumlah_stok) {
            throw new \Exception(
                'Stok item lama tidak mencukupi untuk memperbarui transaksi ini.'
            );
        }

        // 1️⃣ Kembalikan stok lama
        $itemLama->jumlah_stok -= $barangmasuk->jumlah_stok;
        $itemLama->save();

        // 2️⃣ Update transaksi
        $barangmasuk->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'id_item'       => $request->id_item,
            'id_supplier'   => $request->id_supplier,
            'jumlah_stok'   => $request->jumlah_stok,
        ]);

        // 3️⃣ Tambah stok item baru
        $itemBaru = Item::findOrFail($request->id_item);
        $itemBaru->jumlah_stok += $request->jumlah_stok;
        $itemBaru->save();

        DB::commit();

        return redirect()->route('barangmasuk.index')
            ->with('success', 'Transaksi barang masuk berhasil diperbarui');

    } catch (\Exception $e) {
        DB::rollBack();

        // ✅ PENTING: kembali ke FORM EDIT
        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}

public function laporan()
{
    // Mengambil semua data barang masuk beserta relasinya
    $barangMasuk = \App\Models\BarangMasuk::with(['item', 'supplier', 'user'])
        ->orderBy('tanggal_masuk', 'desc')
        ->get();

    return view('barangmasuk.laporan', compact('barangMasuk'));
}

}
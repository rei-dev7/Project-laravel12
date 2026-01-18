<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class HistoriController extends Controller
{
    // ================= BARANG MASUK =================
    public function barangMasuk(Request $request)
    {
        $query = BarangMasuk::with(['item', 'supplier', 'user']);

        // SEARCH
        if ($request->search) {
            $query->whereHas('item', function ($q) use ($request) {
                $q->where('nama_item', 'like', '%' . $request->search . '%');
            });
        }

        // SORT
        if ($request->sort == 'oldest') {
            $query->orderBy('tanggal_masuk', 'asc');
        } else {
            $query->orderBy('tanggal_masuk', 'desc');
        }

        $barangMasuk = $query->paginate(10)->withQueryString();

        return view('histori.masuk', compact('barangMasuk'));
    }

    // ================= BARANG KELUAR =================
    public function barangKeluar(Request $request)
    {
        $query = BarangKeluar::with(['item', 'kategoriTujuan', 'user']);

        // SEARCH
        if ($request->search) {
            $query->whereHas('item', function ($q) use ($request) {
                $q->where('nama_item', 'like', '%' . $request->search . '%');
            });
        }

        // SORT
        if ($request->sort == 'oldest') {
            $query->orderBy('tanggal_keluar', 'asc');
        } else {
            $query->orderBy('tanggal_keluar', 'desc');
        }

        $barangKeluar = $query->paginate(10)->withQueryString();

        return view('histori.keluar', compact('barangKeluar'));
    }
}

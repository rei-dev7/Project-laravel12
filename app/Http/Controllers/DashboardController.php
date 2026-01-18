<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Item;
use App\Models\SubKategori;
use App\Models\KategoriTujuan;
use App\Models\User;
use App\Models\Kategori;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ===== STATISTIK =====
        $totalSupplier       = Supplier::count();
        $totalItem           = Item::count();
        $totalSubkategori    = SubKategori::count();
        $totalKategoriTujuan = KategoriTujuan::count();
        $totalUser           = User::count();
        $totalKategori       = Kategori::count();

        // ===== GRAFIK BARANG MASUK =====
        $barangMasuk = BarangMasuk::select(
                DB::raw('MONTH(tanggal_masuk) as bulan'),
                DB::raw('SUM(jumlah_stok) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // ===== GRAFIK BARANG KELUAR =====
        $barangKeluar = BarangKeluar::select(
                DB::raw('MONTH(tanggal_keluar) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('dashboard', compact(
            'totalSupplier',
            'totalItem',
            'totalSubkategori',
            'totalKategoriTujuan',
            'totalUser',
            'totalKategori',
            'barangMasuk',
            'barangKeluar'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KategoriTujuan;
use Illuminate\Http\Request;

class KategoriTujuanController extends Controller
{
    /**
     * Menampilkan daftar semua data kategori tujuan (READ).
     */
    public function index()
    {
        $kategoriTujuan = KategoriTujuan::orderBy('nama_tujuan')->get();
        return view('kategoritujuan.index', compact('kategoriTujuan'));
    }

    /**
     * Menampilkan form untuk membuat kategori tujuan baru (CREATE - form).
     */
    public function create()
    {
        return view('kategoritujuan.create');
    }

    /**
     * Menyimpan kategori tujuan baru ke database (CREATE - store).
     */
    public function store(Request $request)
    {
        // Validasi input
        // Penting: Tangkap hasil validasi ke $validatedData
        $validatedData = $request->validate([
            'nama_tujuan' => 'required|unique:kategori_tujuan|max:100',
            'tipe' => 'required|string|max:50',
        ], [
            'nama_tujuan.required' => 'Nama Tujuan wajib diisi.',
            'nama_tujuan.unique' => 'Nama Tujuan sudah ada, gunakan nama lain.',
            'tipe.required' => 'Tipe Tujuan wajib diisi.',
        ]);

        // Simpan data menggunakan array yang sudah divalidasi ($validatedData)
        // Ini memastikan field 'nama_tujuan' yang sudah lolos validasi pasti disertakan.
        KategoriTujuan::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('kategoritujuan.index')->with('success', 'Data Kategori Tujuan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kategori tujuan tertentu (UPDATE - form).
     */
    public function edit(KategoriTujuan $kategoritujuan)
    {
        return view('kategoritujuan.edit', compact('kategoritujuan'));
    }

    /**
     * Memperbarui kategori tujuan di database (UPDATE - store).
     */
    public function update(Request $request, KategoriTujuan $kategoritujuan)
    {
        // Validasi input
        $validatedData = $request->validate([
            // Memastikan nama tujuan unik, kecuali untuk kategori yang sedang diedit
            'nama_tujuan' => 'required|max:100|unique:kategori_tujuan,nama_tujuan,' . $kategoritujuan->id_kategori_tujuan . ',id_kategori_tujuan',
            'tipe' => 'required|string|max:50',
        ], [
            'nama_tujuan.required' => 'Nama Tujuan wajib diisi.',
            'nama_tujuan.unique' => 'Nama Tujuan sudah ada, gunakan nama lain.',
            'tipe.required' => 'Tipe Tujuan wajib diisi.',
        ]);

        // Update data
        $kategoritujuan->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('kategoritujuan.index')->with('success', 'Data Kategori Tujuan berhasil diperbarui.');
    }

    /**
     * Menghapus kategori tujuan dari database (DELETE).
     */
    public function destroy(KategoriTujuan $kategoritujuan)
    {
        // Hapus data
        // Catatan: Pastikan tidak ada Barang Keluar yang merujuk kategori ini sebelum dihapus.
        $kategoritujuan->delete(); 

        // Redirect dengan pesan sukses
        return redirect()->route('kategoritujuan.index')->with('success', 'Data Kategori Tujuan berhasil dihapus.');
    }
}
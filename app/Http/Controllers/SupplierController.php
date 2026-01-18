<?php

namespace App\Http\Controllers;

use App\Models\Supplier; // Import Model Supplier
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar data Supplier. (READ)
     */
    public function index()
    {
        // Ambil semua data supplier dari database
        $suppliers = Supplier::orderBy('nama_supplier', 'asc')->get();
        
        // Tampilkan view 'supplier.index' dan kirim data suppliers
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Menampilkan form untuk membuat Supplier baru. (CREATE - Form)
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Menyimpan Supplier baru ke database. (CREATE - Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')
                         ->with('success', 'Data Supplier berhasil ditambahkan!');
    }

    public function destroy(Supplier $supplier)
{
    try {
        $supplier->delete();
        return redirect()->route('supplier.index')
                         ->with('success', 'Data Supplier berhasil dihapus!');
    } catch (\Illuminate\Database\QueryException $e) {
        // Tangani jika data Supplier sedang digunakan (Foreign Key Constraint)
        return redirect()->route('supplier.index')
                         ->with('error', 'Gagal menghapus! Supplier ini masih terkait dengan data Barang Masuk.');
    }
}
public function edit(Supplier $supplier)
    {
        // Variabel $supplier secara otomatis diisi oleh Laravel
        return view('supplier.edit', compact('supplier'));
    }
    public function update(Request $request, Supplier $supplier)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        // 2. Update data supplier
        $supplier->update($request->all());

        // 3. Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('supplier.index')
                         ->with('success', 'Data Supplier "' . $supplier->nama_supplier . '" berhasil diperbarui!');
    }
}
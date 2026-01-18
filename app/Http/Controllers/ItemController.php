<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\SubKategori;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Menampilkan daftar semua data item (READ).
     */
    public function index()
    {
        // Eager loading untuk mengambil Kategori melalui relasi Sub Kategori (subKategori.kategori)
        $item = Item::with(['subKategori.kategori']) 
                    ->orderBy('id_item', 'desc')
                    ->get();
        
        // Mengirim data ke view
        return view('item.index', compact('item'));
    }

    /**
     * Menampilkan form untuk membuat item baru.
     */
    public function create()
    {
        // Ambil semua Sub Kategori dengan relasi Kategori untuk dropdown
        $subKategori = SubKategori::with('kategori')->orderBy('nama_sub_kategori')->get();
        // Daftar Satuan yang tersedia
        $satuan = ['Pcs', 'Unit', 'Box', 'Kg', 'Meter', 'Pack']; 
        
        return view('item.create', compact('subKategori', 'satuan'));
    }

    /**
     * Menyimpan item baru ke database (CREATE).
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_item' => 'required|string|max:50|unique:item,kode_item',
            'nama_item' => 'required|string|max:100',
            'id_sub_kategori' => 'nullable|exists:sub_kategori,id_sub_kategori',
            'satuan' => 'required|string|max:20',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            Item::create($validatedData);

            return redirect()->route('item.index')->with('success', 'Data Item "' . $validatedData['nama_item'] . '" berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data item. Error: ' . $e->getMessage());
        }
    }

    

    /**
     * Menampilkan form untuk mengedit item.
     * Menggunakan Route Model Binding ($item) untuk mendapatkan data item.
     */
   public function edit($id_item)
{
    $item = Item::findOrFail($id_item);
    $subKategori = SubKategori::with('kategori')->orderBy('nama_sub_kategori')->get();
    $satuan = ['Pcs', 'Unit', 'Box', 'Kg', 'Meter', 'Pack'];

    return view('item.edit', compact('item', 'subKategori', 'satuan'));
}

public function update(Request $request, $id_item)
{
    $item = Item::findOrFail($id_item);

    $validatedData = $request->validate([
        'kode_item' => 'required|string|max:50|unique:item,kode_item,' . $item->id_item . ',id_item',
        'nama_item' => 'required|string|max:100',
        'id_sub_kategori' => 'nullable|exists:sub_kategori,id_sub_kategori',
        'satuan' => 'required|string|max:20',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
    ]);

    $item->update($validatedData);

    return redirect()->route('item.index')->with('success', 'Data Item "' . $item->nama_item . '" berhasil diperbarui!');
}

public function destroy($id_item)
{
    $item = Item::findOrFail($id_item);
    $item->delete();

    return redirect()->route('item.index')->with('success', 'Item berhasil dihapus!');
}

    /**
     * Mengambil Sub Kategori berdasarkan Kategori ID untuk AJAX/JS.
     */
    public function getSubKategoriByKategori($id_kategori)
    {
        $subKategori = SubKategori::where('id_kategori', $id_kategori)
                                    ->orderBy('nama_sub_kategori')
                                    ->get(['id_sub_kategori', 'nama_sub_kategori']);

        return response()->json($subKategori);
    }
    public function show($id)
{
    // Mengambil data item beserta subKategori dan kategori
    $item = Item::with(['subKategori.kategori'])->findOrFail($id);
    
    return view('item.show', compact('item'));
}

public function laporan()
{
    $items = Item::with(['subKategori.kategori'])->orderBy('nama_item', 'asc')->get();
    return view('item.laporan', compact('items'));
}
}
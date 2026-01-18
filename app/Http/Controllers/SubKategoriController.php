<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;

class SubKategoriController extends Controller
{
    public function index()
    {
        $subKategori = SubKategori::with('kategori')
            ->orderBy('id_sub_kategori', 'desc')
            ->get();

        return view('subkategori.index', compact('subKategori'));
    }

    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        return view('subkategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_sub_kategori' => 'required|unique:sub_kategori|max:100',
        ]);

        SubKategori::create([
            'id_kategori' => $request->id_kategori,
            'nama_sub_kategori' => $request->nama_sub_kategori,
        ]);

        return redirect()->route('subkategori.index')
            ->with('success', 'Sub Kategori berhasil ditambahkan');
    }

    /** ✅ WAJIB $subkategori */
    public function edit(SubKategori $subkategori)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('subkategori.edit', [
            'subKategori' => $subkategori,
            'kategori' => $kategori
        ]);
    }

    /** ✅ WAJIB $subkategori */
    public function update(Request $request, SubKategori $subkategori)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_sub_kategori' => 'required|max:100|unique:sub_kategori,nama_sub_kategori,' 
                . $subkategori->id_sub_kategori . ',id_sub_kategori',
        ]);

        $subkategori->update([
            'id_kategori' => $request->id_kategori,
            'nama_sub_kategori' => $request->nama_sub_kategori,
        ]);

        return redirect()->route('subkategori.index')
            ->with('success', 'Sub Kategori berhasil diperbarui');
    }

    /** ✅ WAJIB $subkategori */
    public function destroy(SubKategori $subkategori)
    {
        $subkategori->delete();

        return redirect()->route('subkategori.index')
            ->with('success', 'Sub Kategori berhasil dihapus');
    }
}

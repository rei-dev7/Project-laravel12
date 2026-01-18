@extends('layouts.app')

@section('title', 'Detail Item: ' . $item->nama_item)

@section('content')
<div class="w-full px-6 py-6">
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl border border-gray-200 overflow-hidden">
        
        {{-- Header Detail --}}
        <div class="p-8 bg-gradient-to-r from-indigo-600 to-indigo-700 flex justify-between items-center">
            <div class="flex items-center space-x-4 text-white">
                <div class="p-3 bg-white/20 rounded-2xl">
                    <i class="bi bi-box-seam text-3xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold uppercase tracking-tight">{{ $item->nama_item }}</h2>
                    <p class="text-indigo-100 font-medium">Kode Item: {{ $item->kode_item }}</p>
                </div>
            </div>
            <a href="{{ route('item.index') }}" class="bg-white/20 hover:bg-white/30 text-white px-5 py-2 rounded-xl transition font-semibold">
                <i class="bi bi-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Kolom Kiri: Informasi Utama --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black uppercase text-gray-400 tracking-widest">Informasi Utama</h4>
                    
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-xs text-gray-500 font-bold mb-1">STOK SAAT INI</p>
                        <p class="text-3xl font-black text-indigo-700">{{ number_format($item->jumlah_stok, 0) }} <span class="text-sm font-medium text-gray-400">{{ $item->satuan }}</span></p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 border border-gray-100 rounded-2xl">
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Kategori</p>
                            <p class="font-bold text-gray-800">{{ $item->subKategori->kategori->nama_kategori ?? 'N/A' }}</p>
                        </div>
                        <div class="p-4 border border-gray-100 rounded-2xl">
                            <p class="text-[10px] text-gray-400 font-bold uppercase">Sub Kategori</p>
                            <p class="font-bold text-gray-800">{{ $item->subKategori->nama_sub_kategori ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Metadata/Waktu --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black uppercase text-gray-400 tracking-widest">Metadata Sistem</h4>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-500 text-sm font-medium">Tanggal Dibuat</span>
                            <span class="text-gray-800 text-sm font-bold">{{ $item->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-500 text-sm font-medium">Terakhir Diperbarui</span>
                            <span class="text-gray-800 text-sm font-bold">{{ $item->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-xl">
                            <span class="text-gray-500 text-sm font-medium">Satuan Unit</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-xs font-black">{{ $item->satuan }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Keterangan/Deskripsi (Opsional jika ada di DB) --}}
            <div class="mt-10 p-6 bg-indigo-50/50 rounded-3xl border border-indigo-100">
                <h4 class="text-xs font-black uppercase text-indigo-600 tracking-widest mb-3">Keterangan Item</h4>
                <p class="text-gray-600 leading-relaxed italic">
                    {{ $item->keterangan ?? 'Tidak ada deskripsi tambahan untuk item ini.' }}
                </p>
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
            <a href="{{ route('item.edit', $item->id_item) }}" class="px-6 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-bold shadow-md shadow-indigo-100">
                <i class="bi bi-pencil-square mr-2"></i> Edit Data Ini
            </a>
        </div>
    </div>
</div>
@endsection
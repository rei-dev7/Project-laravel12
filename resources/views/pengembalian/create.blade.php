@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <div class="max-w-4xl mx-auto bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.1)] border border-gray-50 overflow-hidden">
        
        <div class="bg-indigo-600 p-8 text-white">
            <h2 class="text-2xl font-black tracking-tight flex items-center gap-3">
                <i class="bi bi-arrow-left-right"></i> Pengembalian <span class="opacity-70">Barang</span>
            </h2>
        </div>

        <div class="p-8">
            {{-- INFO PEMINJAMAN --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-indigo-50/50 p-6 rounded-3xl border border-indigo-100/50 text-sm">
                <div class="space-y-2">
                    <p class="text-gray-500 uppercase text-[10px] font-black tracking-widest">Peminjam</p>
                    <p class="text-indigo-900 font-bold text-base">{{ $peminjaman->peminjam }}</p>
                </div>
                <div class="space-y-2">
                    <p class="text-gray-500 uppercase text-[10px] font-black tracking-widest">Status Saat Ini</p>
                    <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full font-bold">{{ $peminjaman->status }}</span>
                </div>
            </div>

            <form action="{{ route('pengembalian.store', $peminjaman->id_peminjaman) }}" method="POST">
                @csrf
                <input type="hidden" name="id_peminjaman" value="{{ $peminjaman->id_peminjaman }}">

                {{-- TANGGAL KEMBALI --}}
                <div class="mb-8 group">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Tanggal Kembali</label>
                    <div class="relative">
                        <i class="bi bi-calendar-check absolute left-4 top-1/2 -translate-y-1/2 text-indigo-500"></i>
                        <input type="date" name="tanggal_kembali" value="{{ date('Y-m-d') }}"
                               class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner" required>
                    </div>
                </div>

                {{-- BARANG --}}
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4 ml-1">Detail Item yang Dikembalikan</h3>
                <div class="border border-gray-100 rounded-3xl overflow-hidden mb-8">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500 font-bold">
                            <tr>
                                <th class="px-6 py-4 text-left">Nama Barang</th>
                                <th class="px-6 py-4 text-center">Jumlah Pinjam</th>
                                <th class="px-6 py-4 text-right">Jumlah Kembali</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($peminjaman->detail as $detail)
                            <tr>
                                <td class="px-6 py-4 font-bold text-gray-700">{{ $detail->item->nama_item }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 bg-gray-100 rounded-lg font-medium">{{ $detail->jumlah }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{-- PERBAIKAN DI SINI: Tambahkan ['jumlah'] pada name --}}
                                    <input type="number" 
                                           name="items[{{ $detail->id_item }}][jumlah]" 
                                           min="0" max="{{ $detail->jumlah }}" 
                                           class="w-24 ml-auto block px-3 py-2 bg-indigo-50 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 font-bold text-indigo-600 text-center" 
                                           required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- KONDISI & CATATAN --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Kondisi Barang</label>
                        <select name="kondisi" class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 shadow-inner appearance-none cursor-pointer" required>
                            <option value="baik">🟢 Kondisi Baik</option>
                            <option value="rusak">🟡 Kondisi Rusak</option>
                            <option value="hilang">🔴 Hilang / Lenyap</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Catatan Tambahan</label>
                        <textarea name="catatan" rows="1" class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 shadow-inner" placeholder="Opsional..."></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('pengembalian.index') }}" class="text-gray-400 font-bold hover:text-gray-600 transition">Batal</a>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-200 transition-all hover:-translate-y-1 active:scale-95">
                        Konfirmasi Pengembalian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
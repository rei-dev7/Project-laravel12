@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <div class="max-w-5xl mx-auto bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.08)] border border-gray-50 overflow-hidden">
        
        <div class="bg-indigo-600 p-8 text-white">
            <h2 class="text-2xl font-black tracking-tight flex items-center gap-3">
                <i class="bi bi-box-seam"></i> Form <span class="opacity-70">Peminjaman Barang</span>
            </h2>
        </div>

        <div class="p-8">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                {{-- INFO PEMINJAM --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Nama Peminjam</label>
                        <div class="relative">
                            <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-indigo-500"></i>
                            <input type="text" name="peminjam" required 
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner" 
                                   placeholder="Nama Lengkap">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Pinjam</label>
                        <div class="relative">
                            <i class="bi bi-calendar-event absolute left-4 top-1/2 -translate-y-1/2 text-indigo-500"></i>
                            <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" required
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Batas Kembali</label>
                        <div class="relative">
                            <i class="bi bi-calendar-check absolute left-4 top-1/2 -translate-y-1/2 text-indigo-500"></i>
                            <input type="date" name="tanggal_kembali_rencana" required
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Keterangan</label>
                        <div class="relative">
                            <i class="bi bi-info-circle absolute left-4 top-1/2 -translate-y-1/2 text-indigo-500"></i>
                            <input type="text" name="keterangan" required
                                   class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner"
                                   placeholder="Tujuan pinjam">
                        </div>
                    </div>
                </div>

                {{-- TABEL BARANG --}}
                <div class="flex items-center justify-between mb-4 px-1">
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-widest">Pilih Barang</h3>
                    <span class="text-[10px] font-bold bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full uppercase">Stok Real-time</span>
                </div>

                <div class="border border-gray-100 rounded-[2rem] overflow-hidden mb-10 shadow-sm">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500 font-bold uppercase text-[10px] tracking-widest">
                            <tr>
                                <th class="px-6 py-5 text-left">Detail Barang</th>
                                <th class="px-6 py-5 text-center w-32">Stok</th>
                                <th class="px-6 py-5 text-center w-48">Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($item as $row)
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-white border border-gray-100 rounded-lg flex items-center justify-center text-indigo-500 shadow-sm group-hover:scale-110 transition-transform">
                                            <i class="bi bi-box"></i>
                                        </div>
                                        <span class="font-bold text-gray-700">{{ $row->nama_item }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 bg-gray-100 rounded-lg font-black text-gray-500">
                                        {{ $row->jumlah_stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-center">
                                        <input type="number"
                                            name="item[{{ $row->id_item }}]"
                                            min="0"
                                            max="{{ $row->jumlah_stok }}"
                                            class="w-24 px-3 py-2 bg-white border-2 border-gray-100 rounded-xl focus:border-indigo-500 focus:ring-0 text-center font-bold text-indigo-600 transition"
                                            placeholder="0">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-gray-50 pt-8">
                    <a href="{{ route('peminjaman.index') }}" class="text-gray-400 font-bold hover:text-gray-600 transition">Batal</a>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-200 transition-all hover:-translate-y-1 active:scale-95">
                        Simpan Data Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
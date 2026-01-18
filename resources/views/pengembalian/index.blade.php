@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.05)] border border-gray-50 overflow-hidden">
        
        <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gradient-to-r from-white to-indigo-50/30">
            <div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Riwayat <span class="text-indigo-600">Pengembalian</span></h2>
                <p class="text-gray-400 text-sm font-medium">Daftar barang yang telah diproses kembali ke gudang</p>
            </div>
             <a href="{{ route('pengembalian.laporan.cetak') }}" 
       target="_blank"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg transition">
        <i class="bi bi-printer"></i> Cetak Laporan Lengkap
    </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 bg-gray-50/50">
                        <th class="px-8 py-5">Peminjam</th>
                        <th class="px-8 py-5 text-center">Tgl Kembali</th>
                        <th class="px-8 py-5 text-center">Kondisi</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pengembalian as $item)
                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition-all">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-700 block">{{ $item->peminjaman->peminjam ?? 'N/A' }}</span>
                                    <span class="text-[10px] text-gray-400 uppercase tracking-tight">ID: #{{ $item->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center text-gray-500 font-medium text-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-black uppercase">
                            {{ $item->kondisi }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('pengembalian.show', $item->id_peminjaman) }}" 
                               class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-600 px-5 py-2.5 rounded-xl font-bold text-xs hover:border-indigo-600 hover:text-indigo-600 transition-all shadow-sm">
                                <i class="bi bi-eye-fill"></i> Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">Belum ada data pengembalian.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
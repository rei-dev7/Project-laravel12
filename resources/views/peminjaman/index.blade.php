@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.05)] border border-gray-50 overflow-hidden">
        
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center bg-gradient-to-r from-white to-indigo-50/30 gap-4">
            <div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight">Data <span class="text-indigo-600">Peminjaman</span></h2>
                <p class="text-gray-400 text-sm font-medium">Kelola aktivitas peminjaman inventaris barang</p>
            </div>
            <a href="{{ route('peminjaman.laporan') }}"
           class="inline-flex items-center px-6 py-3 bg-indigo-500 text-white font-semibold rounded-xl hover:bg-indigo-600 transition shadow-md">
            <i class="bi bi-file-earmark-bar-graph mr-2"></i>
            Laporan Peminjaman
        </a>
            <a href="{{ route('peminjaman.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                <i class="bi bi-plus-lg text-lg"></i>
                Tambah Peminjaman
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 bg-gray-50/50">
                        <th class="px-8 py-5">Peminjam</th>
                        <th class="px-8 py-5 text-center">Tanggal Pinjam</th>
                        <th class="px-8 py-5 text-center">Rencana Kembali</th>
                        <th class="px-8 py-5 text-center">Status</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach ($peminjaman as $row)
                    <tr class="hover:bg-indigo-50/20 transition-colors group">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-bold group-hover:scale-110 transition-transform">
                                    {{ substr($row->peminjam, 0, 1) }}
                                </div>
                                <span class="font-bold text-gray-700">{{ $row->peminjam }}</span>
                            </div>
                        </td>

                        <td class="px-8 py-5 text-center">
                            <div class="inline-flex items-center gap-2 text-gray-500 font-medium text-sm">
                                <i class="bi bi-calendar-event text-indigo-300"></i>
                                {{ $row->tanggal_pinjam }}
                            </div>
                        </td>

                        <td class="px-8 py-5 text-center">
                            <div class="inline-flex items-center gap-2 text-gray-500 font-medium text-sm">
                                <i class="bi bi-calendar-check text-orange-300"></i>
                                {{ $row->tanggal_kembali_rencana }}
                            </div>
                        </td>

                        <td class="px-8 py-5 text-center">
                            @if($row->status == 'dipinjam')
                                <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $row->status }}
                                </span>
                            @elseif($row->status == 'dikembalikan')
                                <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $row->status }}
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-black uppercase tracking-wider">
                                    {{ $row->status }}
                                </span>
                            @endif
                        </td>

                        <td class="px-8 py-5 text-right">
                            <a href="{{ route('pengembalian.create', $row) }}"
                               class="inline-flex items-center gap-2 bg-white border-2 border-green-500 text-green-600 hover:bg-green-500 hover:text-black px-4 py-2 rounded-xl font-bold text-xs transition-all duration-300 shadow-sm">
                                <i class="bi bi-arrow-return-left"></i>
                                Pengembalian
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-gray-50/50 border-t border-gray-50 text-center">
            <p class="text-xs text-gray-400 font-medium italic">Menampilkan seluruh data peminjaman yang terdaftar dalam sistem.</p>
        </div>
    </div>
</div>
@endsection
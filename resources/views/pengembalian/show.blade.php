@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <div class="max-w-4xl mx-auto">
        
        <a href="{{ route('pengembalian.index') }}" class="inline-flex items-center gap-2 text-gray-400 font-bold text-sm mb-6 hover:text-indigo-600 transition">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>

        <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-50 overflow-hidden">
            <div class="bg-indigo-600 p-8 text-white flex justify-between items-center">
                <div>
                    <p class="text-indigo-200 text-xs font-black uppercase tracking-widest mb-1">Bukti Pengembalian</p>
                    <h2 class="text-2xl font-black tracking-tight">ID #{{ $pengembalian->id }}</h2>
                </div>
                <div class="text-right">
                    <span class="px-4 py-2 bg-white/20 rounded-xl font-bold text-sm backdrop-blur-md">
                        <i class="bi bi-check2-all"></i> Selesai
                    </span>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8 mb-10 bg-gray-50 p-6 rounded-3xl border border-dashed border-gray-200">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Peminjam</p>
                        <p class="font-bold text-gray-800">{{ $pengembalian->peminjaman->peminjam }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tgl Kembali</p>
                        <p class="font-bold text-gray-800">{{ $pengembalian->tanggal_kembali }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Kondisi Saat Kembali</p>
                        <span class="font-bold text-indigo-600 capitalize">🟢 {{ $pengembalian->kondisi }}</span>
                    </div>
                </div>

                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4 ml-1">Item yang Dikembalikan</h3>
                <div class="border border-gray-100 rounded-3xl overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left font-bold text-gray-500">Nama Barang</th>
                                <th class="px-6 py-4 text-center font-bold text-gray-500">Jumlah Dikembalikan</th>
                            </tr>
                        </thead>
<tbody class="divide-y divide-gray-50">
    @foreach($pengembalian->detail as $detail)
    <tr>
        <td class="px-6 py-4 font-bold text-gray-700">{{ $detail->item->nama_item }}</td>
        <td class="px-6 py-4 text-center font-black text-indigo-600">{{ $detail->jumlah }}</td>
    </tr>
    @endforeach
</tbody>
                    </table>
                </div>

                @if($pengembalian->catatan)
                <div class="mt-8">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Catatan Petugas</p>
                    <div class="p-4 bg-gray-50 rounded-2xl italic text-gray-600 text-sm border-l-4 border-indigo-500">
                        "{{ $pengembalian->catatan }}"
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Data Barang Keluar')

@section('content')
<div class="w-full px-6 py-6">

    <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8">

        {{-- Alert --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 px-5">
            <h2 class="text-4xl font-extrabold text-gray-900 flex items-center gap-3">
                <i class="bi bi-box-arrow-right text-red-600 text-4xl"></i>
                <span>Data Transaksi Barang Keluar</span>
            </h2>
            {{-- Tombol Laporan --}}
        <a href="{{ route('barangkeluar.laporan') }}"
           class="inline-flex items-center px-6 py-3 bg-red-600 text-black font-semibold rounded-xl hover:bg-red-700 transition shadow-md">
            <i class="bi bi-file-earmark-bar-graph mr-2"></i>
            Laporan Barang Keluar
        </a>

            <a href="{{ route('barangkeluar.create') }}"
               class="inline-flex items-center px-6 py-3 bg-red-600 text-black font-semibold rounded-xl hover:bg-red-700 transition shadow-md">
                <i class="bi bi-plus-circle mr-2"></i>
                Catat Barang Keluar
            </a>
        </div>

        {{-- Total --}}
        <div class="flex items-center mb-6 px-5">
            <div class="flex items-center bg-white px-5 py-2 rounded-xl border border-gray-300 shadow">
                <i class="bi bi-collection mr-2 text-red-600"></i>
                <span class="text-gray-700">
                    Total Transaksi:
                    <span class="font-bold text-red-700">{{ $barangKeluar->count() }}</span>
                </span>
            </div>
        </div>

        {{-- Table --}}
        <div class="w-full overflow-x-auto">
    <table class="w-full table-fixed border-collapse">
                {{-- Head --}}
                <thead class="text-black">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase w-12 rounded-tl-xl">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Item</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase">Kuantitas</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Tujuan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Dicatat Oleh</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase w-40 rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200">

                    @forelse($barangKeluar as $item)
                        <tr class="hover:bg-red-50 transition">

                            <td class="px-6 py-4">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $item->item->nama_item ?? '-' }}
                            </td>

                            {{-- FIX UTAMA: kuantitas --}}
                            <td class="px-6 py-4 text-center font-bold text-red-600">
                                -{{ number_format($item->jumlah) }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $item->kategoriTujuan->nama_tujuan ?? '-' }}
                                </span>
                            </td>

                            {{-- FIX RELASI USER --}}
                            <td class="px-6 py-4 text-sm text-black-600">{{ $item->user ? $item->user->username : '-' }}
                        </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">

                                    <a href="{{ route('barangkeluar.edit', $item->id_keluar) }}"
                                       class="px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition text-sm font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('barangkeluar.destroy', $item->id_keluar) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus transaksi ini? Stok akan dikembalikan.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500 bg-gray-50">
                                <i class="bi bi-box-fill text-4xl text-gray-400"></i>
                                <div class="mt-2 text-lg">Belum ada transaksi barang keluar.</div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

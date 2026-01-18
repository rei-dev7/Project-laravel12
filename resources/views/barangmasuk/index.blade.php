@extends('layouts.app')

@section('title', 'Data Barang Masuk')

@section('content')
<div class="w-full px-6 py-6">

    <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8">

        {{-- Alert --}}
        @if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <i class="bi bi-check-circle-fill mr-2"></i>
        {{ session('success') }}
    </div>
@endif


        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 px-5">
            <h2 class="text-4xl font-extrabold text-gray-900 flex items-center gap-3">
                <i class="bi bi-box-arrow-in-down text-blue-600 text-4xl"></i>
                <span>Data Transaksi Barang Masuk</span>
            </h2>
                <a href="{{ route('barangmasuk.laporan') }}"
           class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition shadow-md">
            <i class="bi bi-file-earmark-pdf mr-2"></i>
            Lihat Laporan
        </a>
            <a href="{{ route('barangmasuk.create') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-md">
                <i class="bi bi-plus-circle mr-2"></i>
                Catat Barang Masuk
            </a>
        </div>

        {{-- Total --}}
        <div class="flex items-center mb-6 px-5">
            <div class="flex items-center bg-white px-5 py-2 rounded-xl border border-gray-300 shadow">
                <i class="bi bi-collection mr-2 text-blue-600"></i>
                <span class="text-gray-700">
                    Total Transaksi:
                    <span class="font-bold text-blue-700">{{ $barangMasuk->count() }}</span>
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
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase">Jumlah</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Supplier</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Dicatat Oleh</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase w-40 rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200">

                    @forelse($barangMasuk as $item)
                        <tr class="hover:bg-blue-50 transition">

                            <td class="px-6 py-4 text-gray-600">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-900">{{ $item->item->nama_item ?? '-' }}</div>
                                <div class="text-xs text-gray-400 font-normal">ID: {{ $item->id_item }}</div>
                            </td>

                            <td class="px-6 py-4 text-center font-bold text-green">
                                +{{ number_format($item->jumlah_stok) }}
                            </td>

                            <td class="px-8 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $item->supplier->nama_supplier ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600 italic">
                                {{ $item->user ? $item->user->username : 'User #'.$item->id_user }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    {{-- Jika ada route edit, buka komen di bawah --}}
                                    <a href="{{ route('barangmasuk.edit', $item->id_masuk) }}"
                                       class="px-3 py-1.5 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition text-sm font-medium">
                                        Edit
                                    </a> 

                                    <form action="{{ route('barangmasuk.destroy', $item->id_masuk) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus data ini? Stok akan dikurangi kembali otomatis.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-red-500 hover:text-white transition text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-gray-500 bg-gray-50">
                                <i class="bi bi-box-seam text-4xl text-gray-300 block mb-2"></i>
                                <div class="text-lg">Belum ada transaksi barang masuk.</div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
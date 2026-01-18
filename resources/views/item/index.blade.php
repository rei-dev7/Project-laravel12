@extends('layouts.app')

@section('title', 'Data Item (Produk)')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8">
        
        {{-- Pesan Status --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 px-5">
            <h2 class="text-4xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-box-seam-fill text-indigo-600 text-4xl"></i>
                <span>Data Master Item (Produk)</span>
            </h2>

            <a href="{{ route('item.create') }}"
               class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-md">
                <i class="bi bi-plus-circle mr-2"></i>
                Tambah Item Baru
            </a>

            <a href="{{ route('item.laporan') }}" class="inline-flex items-center px-6 py-3 bg-indigo-500 text-white font-semibold rounded-xl hover:bg-indigo-600 transition shadow-md">
        <i class="bi bi-file-earmark-text mr-2"></i>
                Laporan Stok
        </a>
        </div>

        {{-- Total Data --}}
        <div class="flex items-center justify-between mb-6 px-5">
            <div class="flex items-center bg-white px-5 py-2 rounded-xl border border-gray-300 shadow">
                <i class="bi bi-collection mr-2 text-indigo-600"></i>
                <span class="text-gray-700">
                    Total Data: <span class="font-bold text-indigo-700">{{ $item->count() }}</span>
                </span>
            </div>
        </div>

        {{-- Table --}}
        <div class="w-full bg-white border border-gray-300 rounded-2xl shadow overflow-x-auto">

            <table class="w-full table-auto">
                <thead class="text-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider w-16 rounded-tl-xl">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kode Item</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama Item</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Satuan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Sub Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($item as $i)
                        <tr class="hover:bg-indigo-50 transition">

                            <td class="px-6 py-4">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $i->kode_item }}
                            </td>

                            <td class="px-6 py-4 text-gray-700">
                                {{ $i->nama_item }}
                            </td>

                            {{-- Kategori --}}
                            <td class="px-6 py-4">
                                @if ($i->subKategori && $i->subKategori->kategori)
                                    <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $i->subKategori->kategori->nama_kategori }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Tidak Ada
                                    </span>
                                @endif
                            </td>

                            {{-- Satuan --}}
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $i->satuan ?? 'N/A' }}
                                </span>
                            </td>

                            {{-- Sub Kategori --}}
                            <td class="px-6 py-4">
                                @if ($i->subKategori)
                                    <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $i->subKategori->nama_sub_kategori }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Tidak Ada
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900">{{ number_format($i->jumlah_stok, 0) }}</span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('item.show', $i->id_item) }}"
                                        class="px-4 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition font-medium">
                                            <i class="bi bi-eye-fill mr-1"></i> Detail
                                    </a>
                                    <a href="{{ route('item.edit', $i->id_item) }}"
                                       class="px-4 py-2 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('item.destroy', $i->id_item) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus item {{ $i->nama_item }}? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition font-medium">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-gray-500 bg-gray-50">
                                <i class="bi bi-emoji-frown text-4xl text-gray-400"></i>
                                <div class="mt-2 text-lg">Belum ada data item yang terdaftar.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</div>

@endsection

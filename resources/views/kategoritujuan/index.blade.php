@extends('layouts.app')

@section('title', 'Data Kategori Tujuan')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8">
        
        {{-- Pesan Status (Success/Error) --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">{{ session('error') }}</div>
        @endif

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 px-5">
            <h2 class="text-4xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-pin-map-fill text-indigo-600 text-4xl"></i>
                <span>Data Master Kategori Tujuan</span>
            </h2>

            {{-- Tombol Tambah --}}
            <a href="{{ route('kategoritujuan.create') }}"
               class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl transition shadow-md">
                <i class="bi bi-plus-circle mr-2"></i>
                Tambah Tujuan Baru
            </a>
        </div>

        {{-- Total Data --}}
        <div class="flex items-center justify-between mb-6 px-5">
            <div class="flex items-center bg-white px-5 py-2 rounded-xl border border-gray-300 shadow">
                <i class="bi bi-collection mr-2 text-indigo-600"></i>
                <span class="text-gray-700">
                    Total Data: <span class="font-bold text-indigo-700">{{ $kategoriTujuan->count() }}</span>
                </span>
            </div>
        </div>

        {{-- Table --}}
        <div class="w-full bg-white border border-gray-300 rounded-2xl shadow overflow-x-auto">

            <table class="w-full table-auto">
                {{-- Header Tabel --}}
                <thead class="text-black">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider w-16 rounded-tl-xl">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama Tujuan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider w-40 rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @forelse($kategoriTujuan as $item)
                        <tr class="hover:bg-indigo-50 transition">

                            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                {{ $item->nama_tujuan }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($item->tipe == 'OUT') bg-red-100 text-red-700 
                                    @elseif($item->tipe == 'IN') bg-green-100 text-green-700 
                                    @else bg-gray-100 text-gray-700 
                                    @endif">
                                    {{ $item->tipe }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-3">

                                    <a href="{{ route('kategoritujuan.edit', $item->id_kategori_tujuan) }}"
                                       class="px-4 py-2 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('kategoritujuan.destroy', $item->id_kategori_tujuan) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus kategori tujuan {{ $item->nama_tujuan }}? Tindakan ini tidak dapat dibatalkan.')">
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
                            <td colspan="4" class="text-center py-8 text-gray-500 bg-gray-50">
                                <i class="bi bi-emoji-frown text-4xl text-gray-400"></i>
                                <div class="mt-2 text-lg">Belum ada data kategori tujuan yang terdaftar.</div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

    </div> {{-- END CARD --}}

</div>

@endsection
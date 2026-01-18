@extends('layouts.app')

@section('title', 'Tambah Kategori Tujuan')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200 max-w-xl mx-auto">

        {{-- HEADER --}}
        <div class="py-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-pin-map-fill text-yellow-600 text-4xl"></i>
                <span>Form Tambah Kategori Tujuan</span>
            </h2>

            <p class="text-gray-500 mt-2 ml-10">
                Tentukan tujuan pergerakan barang (keluar atau masuk).
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('kategoritujuan.store') }}" method="POST" class="p-5">
            @csrf

            {{-- Nama Tujuan --}}
            <div class="mb-6">
                <label for="nama_tujuan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Tujuan <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_tujuan" name="nama_tujuan" 
                       value="{{ old('nama_tujuan') }}" required
                       placeholder="Cth: Penjualan Ritel, Transfer Gudang, Stok Opname"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-yellow-500 focus:border-yellow-500 @error('nama_tujuan') border-red-500 @enderror">
                @error('nama_tujuan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Tipe --}}
            <div class="mb-6">
    <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">
        Tipe Tujuan (Ditulis Manual) <span class="text-red-500">*</span>
    </label>
    <input type="text" id="tipe" name="tipe"
           value="{{ old('tipe') }}"
           placeholder="Contoh: IN, OUT, ADJUSTMENT"
           class="w-full border border-gray-300 rounded-xl p-3 shadow-sm
                  focus:ring-yellow-500 focus:border-yellow-500 
                  @error('tipe') border-red-500 @enderror">
    @error('tipe')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror

    <p class="text-xs text-gray-500 mt-2 ml-1">Isi secara manual sesuai kebutuhan.</p>
</div>
            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 pt-5 border-t border-gray-100 mt-4">
                <a href="{{ route('kategoritujuan.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition shadow-sm">
                    <i class="bi bi-x-lg mr-2"></i>
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-yellow-600 text-black font-semibold rounded-xl hover:bg-yellow-700 transition shadow-md">
                    <i class="bi bi-send mr-2"></i>
                    Simpan Kategori Tujuan
                </button>
            </div>

        </form>

    </div> {{-- END CARD --}}

</div>

@endsection
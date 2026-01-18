@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-200 max-w-xl mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-8 py-4">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-tags-fill text-indigo-600 text-3xl"></i>
                <span>Tambah Data Kategori</span>
            </h2>

            <p class="text-gray-500 mt-2">
                Masukkan nama kategori baru untuk pengelompokan item.
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            {{-- Nama Kategori --}}
            <div class="mb-6">
                <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_kategori" name="nama_kategori" 
                       value="{{ old('nama_kategori') }}" required
                       placeholder="Cth: Makanan, Minuman, Elektronik"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_kategori') border-red-500 @enderror">
                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 pt-5 mb-4">
                <a href="{{ route('kategori.index') }}"
                   class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition shadow-sm">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-black bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-lg">
                    Simpan Kategori
                </button>
            </div>

        </form>

    </div> {{-- END CARD --}}

</div>

@endsection
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200 max-w-xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-4 p-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-tag-fill text-indigo-600 text-4xl"></i>
                <span>Edit Kategori: <span class="text-indigo-600">{{ $kategori->nama_kategori }}</span></span>
            </h2>

            <p class="text-gray-500 mt-2 ml-10">
                Perbarui nama kategori yang sudah ada.
            </p>
        </div>

        {{-- FORM --}}
        {{-- FIX: Memastikan parameter yang dikirim adalah id_kategori, yang diperlukan oleh route kategori.update --}}
        <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" class="mt-4 px-3">
            @csrf
            {{-- WAJIB: Gunakan directive @method('PUT') --}}
            @method('PUT') 

            {{-- Nama Kategori --}}
            <div class="mb-6">
                <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_kategori" name="nama_kategori" 
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required
                       placeholder="Cth: Elektronik, Makanan, Minuman"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_kategori') border-red-500 @enderror">
                @error('nama_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 pt-5 border-t border-gray-100 mt-8">
                <a href="{{ route('kategori.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition shadow-sm">
                    <i class="bi bi-x-lg mr-2"></i>
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 text-black font-semibold rounded-xl hover:bg-indigo-700 transition shadow-md">
                    <i class="bi bi-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div> {{-- END CARD --}}

</div>

@endsection
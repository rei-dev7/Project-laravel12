@extends('layouts.app')

@section('title', 'Edit Sub Kategori')

@section('content')

<div class="w-full px-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200 max-w-xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-4 p-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-tags-fill text-indigo-600 text-4xl"></i>
                <span>Edit Sub Kategori: <span class="text-indigo-600">{{ $subKategori->nama_sub_kategori }}</span></span>
            </h2>

            <p class="text-gray-500 mt-2 ml-10">
                Perbarui data sub kategori ini, termasuk kategori induk jika diperlukan.
            </p>
        </div>

        {{-- FORM --}}
        {{-- FIX: Memastikan parameter yang dikirim adalah id_sub_kategori, sesuai dengan Route Model Binding yang sudah dikonfigurasi. --}}
        <form action="{{ route('subkategori.update', $subKategori->id_sub_kategori) }}" method="POST">
    @csrf
    @method('PUT')


            {{-- Pilihan Kategori Induk --}}
            <div class="mb-6">
                <label for="id_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori Induk <span class="text-red-500">*</span>
                </label>
                <select id="id_kategori" name="id_kategori" required
                        class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('id_kategori') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $item)
                        {{-- Logika pre-select: menggunakan old() atau data saat ini ($subKategori) --}}
                        <option value="{{ $item->id_kategori }}" 
                            {{ old('id_kategori', $subKategori->id_kategori) == $item->id_kategori ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Sub Kategori --}}
            <div class="mb-6">
                <label for="nama_sub_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Sub Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_sub_kategori" name="nama_sub_kategori" 
                       value="{{ old('nama_sub_kategori', $subKategori->nama_sub_kategori) }}" required
                       placeholder="Cth: Smartphone, Sayuran Segar, Minuman Soda"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_sub_kategori') border-red-500 @enderror">
                @error('nama_sub_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 pt-5 border-t border-gray-100 mt-4">
                <a href="{{ route('subkategori.index') }}"
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
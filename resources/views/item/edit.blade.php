@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-200 max-w-2xl mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="py-4">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-box-seam-fill text-indigo-600 text-3xl"></i>
                <span>Edit Data Item: <span class="text-indigo-600">{{ $item->nama_item }}</span></span>
            </h2>

            <p class="text-gray-500 mt-2">
                Perbarui informasi detail mengenai item atau produk ini.
            </p>
        </div>

        {{-- FORM DENGAN KOREKSI ROUTE --}}
        {{-- PASTIKAN BARIS INI BENAR: $item harus ada sebagai parameter! --}}
        <form action="{{ route('item.update', $item->id_item) }}" method="POST">
            @csrf
            @method('PUT') 
            
            {{-- Kode Item --}}
            <div class="mb-6">
                <label for="kode_item" class="block text-sm font-semibold text-gray-700 mb-1">
                    Kode Item <span class="text-red-500">*</span>
                </label>
                <input type="text" id="kode_item" name="kode_item" 
                       value="{{ old('kode_item', $item->kode_item) }}" required
                       placeholder="Masukkan kode item"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('kode_item') border-red-500 @enderror">
                @error('kode_item')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nama Item --}}
            <div class="mb-6">
                <label for="nama_item" class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Item <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_item" name="nama_item" 
                       value="{{ old('nama_item', $item->nama_item) }}" required
                       placeholder="Masukkan nama item/produk"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_item') border-red-500 @enderror">
                @error('nama_item')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sub Kategori (SubKategori diambil dari controller edit function) --}}
            <div class="mb-6">
                <label for="id_sub_kategori" class="block text-sm font-semibold text-gray-700 mb-1">
                    Sub Kategori
                </label>
                <select id="id_sub_kategori" name="id_sub_kategori"
                        class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('id_sub_kategori') border-red-500 @enderror">
                    <option value="" disabled>Pilih Sub Kategori</option>
                    @foreach ($subKategori as $sub)
                        {{-- Memilih nilai lama atau nilai saat ini dari item --}}
                        <option value="{{ $sub->id_sub_kategori }}" 
                                {{ old('id_sub_kategori', $item->id_sub_kategori) == $sub->id_sub_kategori ? 'selected' : '' }}>
                            {{ $sub->nama_sub_kategori }} (Kategori: {{ $sub->kategori->nama_kategori ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('id_sub_kategori')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Satuan --}}
            <div class="mb-6">
                <label for="satuan" class="block text-sm font-semibold text-gray-700 mb-1">
                    Satuan <span class="text-red-500">*</span>
                </label>
                <select id="satuan" name="satuan" required
                        class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('satuan') border-red-500 @enderror">
                    <option value="" disabled>Pilih Satuan</option>
                    @foreach ($satuan as $s)
                        {{-- Memilih nilai lama atau nilai saat ini dari item --}}
                        <option value="{{ $s }}" 
                                {{ old('satuan', $item->satuan) == $s ? 'selected' : '' }}>
                            {{ $s }}
                        </option>
                    @endforeach
                </select>
                @error('satuan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Stok --}}
            <div class="mb-6">
                <input type="hidden" id="stok" name="stok" 
                       value="{{ old('stok', $item->stok) }}" required
                       placeholder="Jumlah stok saat ini"
                       min="0"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('stok') border-red-500 @enderror">
                @error('stok')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Tombol Aksi --}}
            <div class="flex justify-end space-x-4 py-5">
                <a href="{{ route('item.index') }}" 
                   class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition shadow-sm">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 text-sm font-medium text-black bg-green-600 rounded-xl hover:bg-green-700 transition shadow-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div> {{-- END CARD --}}

</div>

@endsection
@extends('layouts.app')

@section('title', 'Tambah Item Baru')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200 max-w-2xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-2 p-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-box-seam-fill text-indigo-600 text-4xl"></i>
                <span>Form Tambah Item Baru</span>
            </h2>

            <p class="text-gray-500 mt-2 ml-10">
                Isi data item produk secara lengkap. Kategori Induk akan diisi otomatis jika Sub Kategori dipilih.
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('item.store') }}" method="POST" class="p-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Kolom 1 --}}
                <div>
                    {{-- Kode Item --}}
                    <div class="mb-6">
                        <label for="kode_item" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kode Item <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kode_item" name="kode_item" 
                               value="{{ old('kode_item') }}" required
                               placeholder="Cth: PRD-001"
                               class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('kode_item') border-red-500 @enderror">
                        @error('kode_item')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Item --}}
                    <div class="mb-6">
                        <label for="nama_item" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Item <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_item" name="nama_item" 
                               value="{{ old('nama_item') }}" required
                               placeholder="Cth: Kopi Robusta Premium"
                               class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_item') border-red-500 @enderror">
                        @error('nama_item')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Satuan (Dropdown hardcoded) --}}
                    <div class="mb-6">
                        <label for="satuan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        {{-- Menggunakan nama field 'satuan' (string) dan select untuk dropdown hardcoded --}}
                        <select id="satuan" name="satuan" required
                                class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('satuan') border-red-500 @enderror">
                            <option value="">-- Pilih Satuan --</option>
                            {{-- Mengulang dari list hardcoded yang dikirim dari controller --}}
                            @foreach ($satuan as $itemSatuan)
                                <option value="{{ $itemSatuan }}" 
                                    {{ old('satuan') == $itemSatuan ? 'selected' : '' }}>
                                    {{ $itemSatuan }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Kolom 2 --}}
                <div>
                    {{-- Sub Kategori (Sekarang menjadi opsi utama) --}}
                    <div class="mb-6">
                        <label for="id_sub_kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Sub Kategori (Opsional)
                        </label>
                        <select id="id_sub_kategori" name="id_sub_kategori"
                                class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('id_sub_kategori') border-red-500 @enderror">
                            <option value="">-- Pilih Sub Kategori (Opsional) --</option>
                            {{-- Menggunakan semua Sub Kategori yang diambil dari controller --}}
                            @foreach ($subKategori as $itemSubKategori)
                                <option value="{{ $itemSubKategori->id_sub_kategori }}" 
                                    {{ old('id_sub_kategori') == $itemSubKategori->id_sub_kategori ? 'selected' : '' }}>
                                    {{ $itemSubKategori->nama_sub_kategori }} ({{ $itemSubKategori->kategori->nama_kategori ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_sub_kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="mb-6">
                        <input type="hidden" id="stok" name="stok" 
                               value="{{ old('stok', 0) }}" required min="0"
                               placeholder="Cth: 100"
                               class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('stok') border-red-500 @enderror">
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 pt-5 border-t border-gray-100 mt-8">
                <a href="{{ route('item.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition shadow-sm">
                    <i class="bi bi-x-lg mr-2"></i>
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 text-black font-semibold rounded-xl hover:bg-indigo-700 transition shadow-md">
                    <i class="bi bi-plus-lg mr-2"></i>
                    Simpan Item
                </button>
            </div>

        </form>

    </div> {{-- END CARD --}}

</div>

{{-- SCRIPT DROPDOWN DINAMIS dihapus karena tidak lagi diperlukan --}}

@endsection
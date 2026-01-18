@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-200 max-w-2xl mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-8 py-4">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                {{-- Menggunakan ikon truk dengan warna hijau untuk edit --}}
                <i class="bi bi-truck text-green-600 text-3xl"></i>
                <span>Edit Data Supplier: <span class="text-indigo-600">{{ $supplier->nama_supplier }}</span></span>
            </h2>

            <p class="text-gray-500 mt-2">
                Perbarui informasi detail mengenai supplier ini.
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('supplier.update', $supplier->id_supplier) }}" method="POST">
            @csrf
            @method('PUT') 
            
            {{-- Nama Supplier --}}
            <div class="mb-6">
                <label for="nama_supplier" class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Supplier <span class="text-red-500">*</span>
                </label>
                {{-- Menggunakan old() untuk retain nilai jika validasi gagal, dan $supplier->nama_supplier sebagai nilai default --}}
                <input type="text" id="nama_supplier" name="nama_supplier" 
                       value="{{ old('nama_supplier', $supplier->nama_supplier) }}" required
                       placeholder="Masukkan nama supplier"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_supplier') border-red-500 @enderror">
                @error('nama_supplier')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Telepon --}}
            <div class="mb-6">
                <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-1">
                    Telepon
                </label>
                <input type="text" id="telepon" name="telepon" 
                       value="{{ old('telepon', $supplier->telepon) }}"
                       placeholder="Cth: 0812xxxxxx"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('telepon') border-red-500 @enderror">
                @error('telepon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="mb-6">
                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-1">
                    Alamat
                </label>
                <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap supplier"
                          class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('alamat') border-red-500 @enderror">{{ old('alamat', $supplier->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Tombol Aksi --}}
            <div class="flex justify-end space-x-4 mb-4 py-5">
                <a href="{{ route('supplier.index') }}" 
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
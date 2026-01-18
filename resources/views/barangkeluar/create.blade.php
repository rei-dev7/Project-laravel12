@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-6">

        <div class="py-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-box-arrow-up text-yellow-600 text-4xl"></i>
                <span>Tambah Transaksi Barang Keluar</span>
            </h2>

            <p class="text-gray-500 mt-2 ml-10">
                Tentukan tujuan pergerakan & kuantitas barang keluar.
            </p>
        </div>

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('barangkeluar.store') }}" method="POST">
            @csrf

            {{-- Pilih Item --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">
                    Pilih Item
                </label>

                <select name="id_item"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                        required>
                    <option value="">-- Pilih Barang --</option>

                    @foreach($item as $items)
                        <option value="{{ $items->id_item }}"
                                {{ old('id_item') == $items->id_item ? 'selected' : '' }}>
                            {{ $items->nama_item }} (Stok: {{ $items->jumlah_stok }})
                        </option>
                    @endforeach
                </select>

                @error('id_item')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah Keluar --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">
                    Jumlah Keluar
                </label>

                <input type="number"
                       name="kuantitas"
                       min="1"
                       value="{{ old('kuantitas') }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                       required>

                @error('kuantitas')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tujuan Keluar --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-semibold mb-2">
                    Tujuan Keluar
                </label>

                <select name="id_kategori_tujuan"
                        class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                        required>
                    <option value="">-- Pilih Tujuan --</option>

                    @foreach($kategoriTujuan as $tujuan)
                        <option value="{{ $tujuan->id_kategori_tujuan }}"
                                {{ old('id_kategori_tujuan') == $tujuan->id_kategori_tujuan ? 'selected' : '' }}>
                            {{ $tujuan->nama_tujuan }}
                        </option>
                    @endforeach
                </select>

                @error('id_kategori_tujuan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Keluar --}}
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">
                    Tanggal Keluar
                </label>

                <input type="datetime-local"
                       name="tanggal_keluar"
                       value="{{ old('tanggal_keluar', date('Y-m-d')) }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-300"
                       required>

                @error('tanggal_keluar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action --}}
            <div class="flex justify-between items-center">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Simpan
                </button>

                <a href="{{ route('barangkeluar.index') }}"
                   class="text-gray-600 hover:underline text-sm">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection

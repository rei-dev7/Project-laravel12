@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 flex items-center">
            <i class="bi bi-box-arrow-in-down text-blue-600 mr-3"></i>
            Catat Barang Masuk
        </h2>

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('barangmasuk.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <!-- Tanggal Masuk -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Masuk</label>
                    <input type="datetime-local" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" 
                           class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 bg-gray-50" required>
                </div>

                <!-- Pilih Item -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Item / Barang</label>
                    <select name="id_item" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 bg-gray-50" required>
                        <option value="">-- Pilih Item --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id_item }}" {{ old('id_item') == $item->id_item ? 'selected' : '' }}>
                                {{ $item->nama_item }} (Stok Saat Ini: {{ $item->jumlah_stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Supplier -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Supplier</label>
                    <select name="id_supplier" class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 bg-gray-50" required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $sup)
                            <option value="{{ $sup->id_supplier }}" {{ old('id_supplier') == $sup->id_supplier ? 'selected' : '' }}>
                                {{ $sup->nama_supplier }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jumlah -->
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Masuk</label>
    <input type="number"
           name="jumlah_stok"
           value="{{ old('jumlah_stok') }}"
           min="1"
           placeholder="Masukkan angka..."
           class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3 bg-gray-50"
           required>
</div>

            </div>

            <div class="mt-10 flex items-center justify-between border-t pt-6">
                <a href="{{ route('barangmasuk.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-xl shadow-lg transition duration-200">
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
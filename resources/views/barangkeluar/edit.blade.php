@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-200 max-w-2xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8 py-4 border-b border-gray-100">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-pencil-square text-red-600 text-4xl"></i>
                <span>Edit Transaksi Barang Keluar</span>
            </h2>

            <p class="text-gray-500 mt-2 ml-10">
                Hati-hati dalam mengubah data, stok akan disesuaikan kembali secara otomatis.
            </p>
        </div>

        {{-- Pesan Status (Error) --}}
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">{{ session('error') }}</div>
        @endif

        {{-- FORM --}}
        <form action="{{ route('barangkeluar.update', $barangKeluar->id_keluar) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            {{-- Tanggal Keluar --}}
            <div class="mb-6">
                <label for="tanggal_keluar" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Keluar <span class="text-red-500">*</span>
                </label>
                <input type="datetime-local" id="tanggal_keluar" name="tanggal_keluar" 
                       value="{{ old('tanggal_keluar', $barangKeluar->tanggal_keluar) }}" required
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-red-500 focus:border-red-500 @error('tanggal_keluar') border-red-500 @enderror">
                @error('tanggal_keluar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Pilihan Item --}}
            <div class="mb-6">
                <label for="id_item" class="block text-sm font-semibold text-gray-700 mb-2">
                    Item <span class="text-red-500">*</span>
                </label>
                <select id="id_item" name="id_item" required
                        class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-red-500 focus:border-red-500 @error('id_item') border-red-500 @enderror">
                    <option value="">-- Pilih Item --</option>
                    @foreach ($item as $item)
                        <option value="{{ $item->id_item }}" 
                            data-stok="{{ $item->jumlah_stok }}"
                            {{ old('id_item', $barangKeluar->id_item) == $item->id_item ? 'selected' : '' }}>
                            {{ $item->nama_item }} 
                            @if(old('id_item', $barangKeluar->id_item) == $item->id_item)
                                (Stok Tersedia Saat Ini: {{ number_format($item->jumlah_stok) }})
                            @else
                                (Stok: {{ number_format($item->jumlah_stok) }})
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('id_item')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kuantitas dan Info Kuantitas Lama --}}
            <div class="mb-6">
                <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kuantitas Keluar <span class="text-red-500">*</span>
                </label>
                <input type="number" id="jumlah" name="jumlah" 
                       value="{{ old('jumlah', $barangKeluar->jumlah) }}" required min="1"
                       placeholder="Masukkan jumlah barang yang keluar"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-red-500 focus:border-red-500 @error('jumlah') border-red-500 @enderror">
                @error('jumlah')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-2 italic">Kuantitas Keluar Lama: {{ number_format($barangKeluar->jumlah) }}</p>
            </div>
            
            {{-- Pilihan Kategori Tujuan --}}
            <div class="mb-6">
                <label for="id_kategori_tujuan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Tujuan Keluar <span class="text-red-500">*</span>
                </label>
                <select id="id_kategori_tujuan" name="id_kategori_tujuan" required
                        class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-red-500 focus:border-red-500 @error('id_kategori_tujuan') border-red-500 @enderror">
                    <option value="">-- Pilih Tujuan Keluar --</option>
                    @foreach ($kategoriTujuan as $tujuan)
                        <option value="{{ $tujuan->id_kategori_tujuan }}" 
                            {{ old('id_kategori_tujuan', $barangKeluar->id_kategori_tujuan) == $tujuan->id_kategori_tujuan ? 'selected' : '' }}>
                            {{ $tujuan->nama_tujuan }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori_tujuan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 pt-5 border-t border-gray-100 mt-8">
                <a href="{{ route('barangkeluar.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition shadow-sm">
                    <i class="bi bi-x-lg mr-2"></i>
                    Batal
                </a>

                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition shadow-md">
                    <i class="bi bi-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div> {{-- END CARD --}}

</div>

<script>
    // Script untuk menampilkan stok yang telah dikoreksi di mode edit
    document.addEventListener('DOMContentLoaded', function() {
        const itemSelect = document.getElementById('id_item');
        
        function updateStokOptions() {
            const selectedId = itemSelect.value;
            // Kuantitas lama dari transaksi yang sedang diedit
            const kuantitasLamaTransaksiIni = {{ $barangKeluar->jumlah }};
            // ID item lama dari transaksi yang sedang diedit
            const idItemLamaTransaksiIni = {{ $barangKeluar->id_item }};
            
            Array.from(itemSelect.options).forEach(option => {
                const itemId = option.value;
                const baseStok = option.getAttribute('data-stok');

                if (itemId) {
                    let adjustedStok = parseInt(baseStok);

                    if (itemId == idItemLamaTransaksiIni) {
                        // Jika item yang dipilih adalah item yang sedang diedit, tambahkan kembali stok lama
                        adjustedStok += kuantitasLamaTransaksiIni;
                        option.textContent = option.textContent.split('(')[0].trim() + ` (Stok Tersedia Saat Ini: ${adjustedStok.toLocaleString('id-ID')})`;
                    } else {
                        // Untuk item lain, tampilkan stok asli
                        option.textContent = option.textContent.split('(')[0].trim() + ` (Stok: ${adjustedStok.toLocaleString('id-ID')})`;
                    }
                }
            });
        }

        updateStokOptions();
        itemSelect.addEventListener('change', updateStokOptions);
    });
</script>

@endsection
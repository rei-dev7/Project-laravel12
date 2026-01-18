@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">
    {{-- Action Buttons --}}
    <div class="flex justify-between items-center mb-6 no-print">
        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">
            Laporan <span class="text-red-600">Barang Keluar</span>
        </h2>
        <div class="flex gap-3">
            <button onclick="window.print()" class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-red-700 transition flex items-center gap-2">
                <i class="bi bi-printer-fill"></i> Cetak Laporan
            </button>
            <a href="{{ route('barangkeluar.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                Kembali
            </a>
        </div>
    </div>

    {{-- Report Paper Wrapper --}}
    <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100 print:shadow-none print:border-none print:p-0">
        
        {{-- Kop Surat --}}
        <div class="text-center border-b-4 border-gray-900 pb-6 mb-8">
            <h1 class="text-3xl font-black uppercase">Laporan Transaksi Barang Keluar</h1>
            <p class="text-gray-500 font-medium italic">Dicetak pada: {{ date('d F Y, H:i') }}</p>
        </div>

        {{-- Tabel Laporan --}}
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 print:bg-gray-200">
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center w-12">No</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Tanggal</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Nama Barang</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Tujuan / Keperluan</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangKeluar as $index => $item)
                <tr class="odd:bg-white even:bg-gray-50/50">
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm font-bold text-gray-800">
                        {{ $item->item->nama_item ?? '-' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center font-black text-red-600">
                        -{{ number_format($item->jumlah) }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                        {{ $item->kategoriTujuan->nama_tujuan ?? $item->keterangan ?? '-' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center text-gray-600">
                        {{ $item->user->username ?? 'Admin' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <div class="mt-16 flex justify-end">
            <div class="text-center w-64">
                <p class="mb-20 text-sm font-bold text-gray-800">Mengetahui, Kepala Gudang</p>
                <div class="border-b-2 border-gray-900 mx-auto w-48"></div>
                <p class="mt-2 text-xs font-black uppercase">( ............................ )</p>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        nav, aside, header, footer, .no-print, .sidebar, #sidebar, .navbar { 
            display: none !important; 
        }
        body { background: white !important; margin: 0; padding: 0; }
        .w-full { width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .rounded-[2.5rem] { border-radius: 0 !important; }
        @page { size: landscape; margin: 1cm; }
    }
</style>
@endsection
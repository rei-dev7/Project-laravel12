@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">
    {{-- Action Buttons --}}
    <div class="flex justify-between items-center mb-6 no-print">
        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">
            Laporan <span class="text-indigo-600">Stok Barang</span>
        </h2>
        <div class="flex gap-3">
            <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <i class="bi bi-printer-fill"></i> Cetak Laporan
            </button>
            <a href="{{ route('item.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                Kembali
            </a>
        </div>
    </div>

    {{-- Report Paper Wrapper --}}
    <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100 print:shadow-none print:border-none print:p-0">
        
        {{-- Kop Surat / Header Laporan --}}
        <div class="text-center border-b-4 border-gray-900 pb-6 mb-8">
            <h1 class="text-3xl font-black uppercase">Laporan Inventaris Logistik</h1>
            <p class="text-gray-500 font-medium italic">Per Tanggal: {{ date('d F Y') }}</p>
        </div>

        {{-- Tabel Laporan --}}
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 print:bg-gray-200">
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center w-12">No</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Kode</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Nama Barang</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Kategori</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Stok</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                <tr class="odd:bg-white even:bg-gray-50/50">
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center font-medium">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center font-bold text-indigo-600">{{ $item->kode_item }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm font-bold text-gray-800">{{ $item->nama_item }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-gray-600">
                        {{ $item->subKategori->kategori->nama_kategori ?? '-' }} / {{ $item->subKategori->nama_sub_kategori ?? '-' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center font-black {{ $item->jumlah_stok < 5 ? 'text-red-600' : 'text-gray-900' }}">
                        {{ number_format($item->jumlah_stok, 0) }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center font-medium text-gray-500">{{ $item->satuan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <div class="mt-16 flex justify-end">
            <div class="text-center w-64">
                <p class="mb-20 text-sm font-bold text-gray-800">Mengetahui, Manajer Logistik</p>
                <div class="border-b-2 border-gray-900 mx-auto w-48"></div>
                <p class="mt-2 text-xs font-black uppercase">( ............................ )</p>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        /* 1. Sembunyikan elemen navigasi umum (Navbar, Sidebar, Footer) */
        nav, 
        aside, 
        header, 
        footer, 
        .no-print,
        #sidebar,      /* ID umum sidebar */
        #navbar,       /* ID umum navbar */
        .sidebar,      /* Class umum sidebar */
        .navbar,       /* Class umum navbar */
        .main-header,  /* Class AdminLTE/Bootstrap */
        .main-sidebar  /* Class AdminLTE/Bootstrap */ {
            display: none !important;
        }

        /* 2. Atur agar konten utama mengambil lebar penuh */
        body, 
        main, 
        .content-wrapper, 
        .container,
        .w-full {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            min-width: 100% !important;
        }

        /* 3. Hilangkan bayangan dan border card agar bersih di kertas */
        .bg-white {
            box-shadow: none !important;
            border: none !important;
        }

        /* 4. Atur margin kertas */
        @page {
            margin: 1.5cm;
        }
    }
</style>
@endsection
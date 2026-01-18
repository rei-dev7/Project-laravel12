@extends('layouts.app')

@section('content')
<div class="w-full px-6 py-6">
    {{-- Action Buttons --}}
    <div class="flex justify-between items-center mb-6 no-print">
        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tighter">
            Laporan <span class="text-amber-600">Peminjaman Barang</span>
        </h2>
        <div class="flex gap-3">
            <button onclick="window.print()" class="bg-amber-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-amber-700 transition flex items-center gap-2">
                <i class="bi bi-printer-fill"></i> Cetak Laporan
            </button>
            <a href="{{ route('peminjaman.index') }}" class="bg-gray-100 text-gray-600 px-6 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                Kembali
            </a>
        </div>
    </div>

    {{-- Report Paper Wrapper --}}
    <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100 print:shadow-none print:border-none print:p-0">
        
        {{-- Kop Surat --}}
        <div class="text-center border-b-4 border-gray-900 pb-6 mb-8">
            <h1 class="text-3xl font-black uppercase">Laporan Riwayat Peminjaman Barang</h1>
            <p class="text-gray-500 font-medium italic">Dicetak pada: {{ date('d F Y') }}</p>
        </div>

        {{-- Tabel Laporan --}}
        <table class="w-full text-left border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 print:bg-gray-200">
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center w-12">No</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Kode & Peminjam</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Barang & Jumlah</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Jumlah Pinjam</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Tgl Pinjam</th>
                    <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase text-center">Status</th>
                    {{-- <th class="border border-gray-300 px-4 py-3 text-xs font-black uppercase">Petugas</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $index => $row)
                <tr class="odd:bg-white even:bg-gray-50/50">
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-sm">
                        <div class="font-bold text-indigo-700">{{ $row->kode_peminjaman }}</div>
                        <div class="text-gray-800">{{ $row->peminjam }}</div>
                    </td>
                   {{-- Kolom Barang Tetap Menampilkan List Nama Barang --}}
        <td class="border border-gray-300 px-4 py-2 text-sm">
            @foreach($row->detail as $d)
                <div class="mb-1 italic">• {{ $d->item->nama_item }}</div>
            @endforeach
        </td>

        {{-- Kolom Jumlah Sekarang Mengambil Dari Tabel Peminjaman Langsung --}}
        <td class="border border-gray-300 px-4 py-2 text-sm text-center font-bold">
            {{ $row->jumlah_pinjam }}
        </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center">
                        {{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d/m/Y') }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-sm text-center font-bold uppercase">
                        <span class="{{ $row->status == 'dipinjam' ? 'text-amber-600' : 'text-emerald-600' }}">
                            {{ $row->status }}
                        </span>
                    </td>
                    {{-- <td class="border border-gray-300 px-4 py-2 text-sm text-center text-gray-600">
    {{ auth()->user()->username }}
</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <div class="mt-16 flex justify-end">
            <div class="text-center w-64">
                <p class="mb-20 text-sm font-bold text-gray-800">Mengetahui, Bagian Sarpras</p>
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
        @page { size: landscape; margin: 1cm; }
    }
</style>
@endsection
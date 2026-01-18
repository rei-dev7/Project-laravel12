@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight flex items-center gap-3">
                <i class="bi bi-box-arrow-right text-red-600"></i>
                Histori <span class="text-red-600">Barang Keluar</span>
            </h2>
            <p class="text-gray-500 font-medium">Lacak distribusi dan pengeluaran aset dari inventaris.</p>
        </div>
        
        <div class="flex gap-3">
            <button class="flex items-center gap-2 bg-white border border-red-100 text-red-600 px-5 py-2.5 rounded-2xl font-bold shadow-sm hover:bg-red-50 transition">
                <i class="bi bi-file-earmark-pdf"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-[0_10px_40px_-15px_rgba(220,38,38,0.1)] border border-gray-50 mb-8">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <div class="relative flex-1 min-w-[250px]">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama item atau lokasi tujuan..."
                       class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 transition shadow-inner text-gray-700">
            </div>

            <div class="relative">
                <select name="sort" class="appearance-none pl-4 pr-10 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-red-500 transition shadow-inner text-gray-700 font-medium cursor-pointer">
                    <option value="latest">Urutkan: Terbaru</option>
                    <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Urutkan: Terlama</option>
                </select>
                <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>

            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-red-200 transition-all hover:-translate-y-1 active:scale-95">
                Filter Data
            </button>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(220,38,38,0.1)] border border-gray-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-red-600 text-white">
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest rounded-tl-3xl">Tanggal Keluar</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest">Item / Produk</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest text-center">Jumlah</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest">Tujuan Distribusi</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest rounded-tr-3xl">Admin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($barangKeluar as $bk)
                    <tr class="group hover:bg-red-50/50 transition-colors">
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-calendar3 text-red-400"></i>
                                {{ \Carbon\Carbon::parse($bk->tanggal_keluar)->format('d M Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $bk->item->nama_item }}</div>
                            <div class="text-[10px] bg-red-50 text-red-600 px-2 py-0.5 rounded w-fit font-black mt-1 uppercase">
                                {{ $bk->item->kode_item ?? 'ITEM-OUT' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block px-4 py-1 bg-red-100 text-red-700 rounded-full font-black border border-red-200 shadow-sm">
                                - {{ $bk->jumlah }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 font-semibold">
                            {{ $bk->kategoriTujuan->nama_tujuan ?? 'Tidak Diketahui' }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                                <span>{{ $bk->user->username ?? 'Administrator' }}</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center text-gray-400 font-bold">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 px-2 custom-pagination">
        {{ $barangKeluar->links() }}
    </div>

</div>

<style>
    /* Styling Pagination Tema Merah */
    .custom-pagination nav svg { width: 1.5rem; }
    .custom-pagination nav span, .custom-pagination nav a {
        border-radius: 12px !important;
        margin: 0 3px;
        border: none !important;
        padding: 8px 16px !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s;
    }
    .custom-pagination nav a:hover { 
        background-color: #dc2626 !important; 
        color: white !important; 
        transform: translateY(-2px);
    }
</style>
@endsection
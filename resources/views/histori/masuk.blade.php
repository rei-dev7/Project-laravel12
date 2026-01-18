@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight flex items-center gap-3">
                <i class="bi bi-clock-history text-indigo-600"></i>
                Histori <span class="text-indigo-600">Barang Masuk</span>
            </h2>
            <p class="text-gray-500 font-medium">Pantau setiap entri stok yang masuk ke gudang.</p>
        </div>
        
        <button class="flex items-center gap-2 bg-white border border-indigo-100 text-indigo-600 px-5 py-2.5 rounded-2xl font-bold shadow-sm hover:bg-indigo-50 transition">
            <i class="bi bi-download"></i> Export Data
        </button>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-[0_10px_40px_-15px_rgba(79,70,229,0.1)] border border-gray-50 mb-8">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <div class="relative flex-1 min-w-[250px]">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari item"
                       class="w-full pl-11 pr-4 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner text-gray-700">
            </div>

            <div class="relative">
                <select name="sort" class="appearance-none pl-4 pr-10 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition shadow-inner text-gray-700 font-medium cursor-pointer">
                    <option value="latest">Urutkan: Terbaru</option>
                    <option value="oldest" {{ request('sort')=='oldest'?'selected':'' }}>Urutkan: Terlama</option>
                </select>
                <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
            </div>

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-200 transition-all hover:-translate-y-1 active:scale-95">
                Terapkan Filter
            </button>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-[0_10px_40px_-15px_rgba(79,70,229,0.1)] border border-gray-50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest rounded-tl-3xl">Tanggal</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest">Item Inventaris</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest text-center">Jumlah</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest">Supplier</th>
                        <th class="px-6 py-4 font-bold uppercase text-xs tracking-widest rounded-tr-3xl">Dicatat Oleh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($barangMasuk as $bm)
                    <tr class="group hover:bg-indigo-50/50 transition-colors">
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            <span class="bg-gray-100 group-hover:bg-white px-3 py-1 rounded-lg transition">
                                {{ \Carbon\Carbon::parse($bm->tanggal_masuk)->format('d M Y') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $bm->item->nama_item }}</div>
                            <div class="text-xs text-indigo-400 font-semibold">{{ $bm->item->kode_item ?? 'SKU-001' }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block px-4 py-1 bg-indigo-100 text-indigo-700 rounded-full font-black">
                                + {{ $bm->jumlah_stok }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-building text-gray-400"></i>
                                <span class="text-gray-700 font-medium">{{ $bm->supplier->nama_supplier }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 italic">
                            <div class="flex items-center gap-2">
                                {{ $bm->user->username ?? 'System Admin' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center opacity-40">
                                <i class="bi bi-inbox text-5xl mb-2"></i>
                                <p class="text-lg font-bold">Tidak ada data ditemukan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 px-2 custom-pagination">
        {{ $barangMasuk->links() }}
    </div>

</div>

<style>
    /* Styling khusus untuk Pagination agar senada dengan Indigo */
    .custom-pagination nav svg { width: 1.5rem; }
    .custom-pagination nav span, .custom-pagination nav a {
        border-radius: 12px !important;
        margin: 0 2px;
        border: none !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .custom-pagination nav a:hover { background-color: #e0e7ff !important; color: #4f46e5 !important; }
</style>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10 min-h-screen">

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h1 class="text-3xl font-black text-gray-800 tracking-tight">
                <span class="text-indigo-600 uppercase">System</span> Analytics
            </h1>
            <p class="text-gray-500 font-medium">Monitoring data inventaris secara real-time.</p>
        </div>
        <div class="bg-indigo-50 px-4 py-2 rounded-2xl border border-indigo-100 flex items-center gap-3">
            <div class="w-3 h-3 bg-indigo-500 rounded-full animate-pulse"></div>
            <span class="text-indigo-700 font-bold text-sm">{{ date('d M Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @php
            $stats = [
                ['label' => 'Total Barang', 'value' => $totalItem, 'icon' => 'bi-box-seam', 'desc' => 'Item terdaftar'],
                ['label' => 'Supplier', 'value' => $totalSupplier, 'icon' => 'bi-truck', 'desc' => 'Mitra aktif'],
                ['label' => 'Kategori', 'value' => $totalKategori, 'icon' => 'bi-grid-1x2', 'desc' => 'Pengelompokan'],
                ['label' => 'Sub Kategori', 'value' => $totalSubkategori, 'icon' => 'bi-layers', 'desc' => 'Detail kategori'],
                ['label' => 'Kategori Tujuan', 'value' => $totalKategoriTujuan, 'icon' => 'bi-geo-alt', 'desc' => 'Lokasi distribusi'],
                ['label' => 'Total User', 'value' => $totalUser, 'icon' => 'bi-people', 'desc' => 'Operator sistem'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="group relative bg-white rounded-3xl p-6 shadow-[0_10px_40px_-15px_rgba(79,70,229,0.1)] border border-gray-50 hover:border-indigo-200 transition-all duration-500 hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-transparent opacity-0 group-hover:opacity-100 rounded-3xl transition-opacity"></div>
            
            <div class="relative flex items-center justify-between mb-4">
                <div class="p-3 rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-200 group-hover:scale-110 transition-transform duration-500">
                    <i class="bi {{ $stat['icon'] }} text-2xl"></i>
                </div>
                <span class="text-xs font-bold text-indigo-400 uppercase tracking-widest">{{ $stat['desc'] }}</span>
            </div>
            
            <div class="relative">
                <p class="text-gray-500 text-sm font-semibold">{{ $stat['label'] }}</p>
                <h2 class="text-4xl font-black text-gray-800 tracking-tight mt-1">{{ $stat['value'] }}</h2>
            </div>

            <div class="mt-5 h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-500 w-2/3 rounded-full group-hover:w-full transition-all duration-700"></div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-6">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50 relative overflow-hidden">
            <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                <i class="bi bi-graph-up-arrow text-indigo-500"></i> Alur Barang Masuk
            </h3>
            <canvas id="barangMasukChart" height="200"></canvas>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-50 relative overflow-hidden">
            <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
                <i class="bi bi-graph-down-arrow text-red-500"></i> Alur Barang Keluar
            </h3>
            <canvas id="barangKeluarChart" height="200"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    
    // Global Styling for Charts
    Chart.defaults.color = '#94a3b8';
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

    // Gradient Generator
    function getGradient(ctx, color) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, color);
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0)');
        return gradient;
    }

    // Data Processing
    const dataMasuk = Array(12).fill(0);
    @foreach($barangMasuk as $bm) dataMasuk[{{ $bm->bulan - 1 }}] = {{ $bm->total }}; @endforeach

    const dataKeluar = Array(12).fill(0);
    @foreach($barangKeluar as $bk) dataKeluar[{{ $bk->bulan - 1 }}] = {{ $bk->total }}; @endforeach

    // Masuk Chart (Indigo Futuristic Line)
    const ctx1 = document.getElementById('barangMasukChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Qty Masuk',
                data: dataMasuk,
                borderColor: '#4f46e5',
                borderWidth: 4,
                pointBackgroundColor: '#4f46e5',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                fill: true,
                backgroundColor: getGradient(ctx1, 'rgba(79, 70, 229, 0.2)'),
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { borderDash: [5, 5] }, beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });

    // Keluar Chart (Bar Modern)
    const ctx2 = document.getElementById('barangKeluarChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Qty Keluar',
                data: dataKeluar,
                borderColor: '#e54646',
                borderWidth: 4,
                pointBackgroundColor: '#e54646',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                fill: true,
                backgroundColor: getGradient(ctx1, 'rgba(79, 70, 229, 0.2)'),
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { borderDash: [5, 5] }, beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap');
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
</style>
@endsection
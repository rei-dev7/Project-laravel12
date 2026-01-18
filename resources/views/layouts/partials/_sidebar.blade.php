<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">
   @php
    use Illuminate\Support\Facades\Route; 

    // Style Aktif: Indigo dengan Glow lembut
    $activeClass = 'bg-indigo-600 text-white shadow-lg shadow-indigo-100 rounded-xl';
    
    // Style Default: Bersih, teks abu-abu, hover indigo muda
    $defaultClass = 'text-gray-500 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-200';
    
    $currentRouteName = Route::currentRouteName() ?? '';

    $isActive = function (string $prefix) use ($currentRouteName, $activeClass, $defaultClass): string {
        if (str_starts_with($currentRouteName, $prefix . '.') || ($prefix === 'dashboard' && $currentRouteName === 'dashboard')) {
            return $activeClass;
        }
        return $defaultClass;
    };
@endphp

<aside class="w-72 bg-white border-r border-gray-100 h-screen sticky top-0 overflow-y-auto flex flex-col">
    
    <div class="p-8 flex items-center space-x-3">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
            <i class="bi bi-cpu-fill text-white text-xl"></i>
        </div>
        <div>
            <span class="text-gray-800 text-[10px] font-black leading-none tracking-widest uppercase block">SI</span>
            <span class="text-indigo-600 text-sm font-bold tracking-tight uppercase">Inventaris Gudang</span>
        </div>
    </div>

    <nav class="flex-1 px-4 pb-6 space-y-1">
        
        <div class="px-4 mt-4 mb-2">
            <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Home Analytics</h3>
        </div>

        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-3 {{ $isActive('dashboard') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-speedometer2 text-lg"></i>
            </div>
            <span class="text-sm font-bold">Dashboard</span>
        </a>

        <div class="px-4 mt-8 mb-2">
            <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Core Database</h3>
        </div>

        <a href="{{ route('user.index') }}" class="flex items-center px-4 py-3 {{ $isActive('user') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-people-fill text-lg"></i>
            </div>
            <span class="text-sm font-bold">Data User</span>
        </a>

        <a href="{{ route('supplier.index') }}" class="flex items-center px-4 py-3 {{ $isActive('supplier') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-truck text-lg"></i>
            </div>
            <span class="text-sm font-bold">Data Supplier</span>
        </a>

        <a href="{{ route('kategori.index') }}" class="flex items-center px-4 py-3 {{ $isActive('kategori') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-grid-1x2 text-lg"></i>
            </div>
            <span class="text-sm font-bold">Data Kategori</span>
        </a>

        <a href="{{ route('subkategori.index') }}" class="flex items-center px-4 py-3 {{ $isActive('subkategori') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-layers text-lg"></i>
            </div>
            <span class="text-sm font-bold">Data Sub Kategori</span>
        </a>

        <a href="{{ route('item.index') }}" class="flex items-center px-4 py-3 {{ $isActive('item') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-box-seam text-lg"></i>
            </div>
            <span class="text-sm font-bold">Data Item</span>
        </a>

        <a href="{{ route('kategoritujuan.index') }}" class="flex items-center px-4 py-3 {{ $isActive('kategoritujuan') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-flag-fill text-lg"></i>
            </div>
            <span class="text-sm font-bold">Data Objective</span>
        </a>

        <div class="px-4 mt-8 mb-2">
            <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">Logistics Control</h3>
        </div>

        <a href="{{ route('barangmasuk.index') }}" class="flex items-center px-4 py-3 {{ $isActive('barangmasuk') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-box-arrow-in-down text-lg"></i>
            </div>
            <span class="text-sm font-bold">Barang Masuk</span>
        </a>

        <a href="{{ route('barangkeluar.index') }}" class="flex items-center px-4 py-3 {{ $isActive('barangkeluar') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-box-arrow-up text-lg"></i>
            </div>
            <span class="text-sm font-bold">Barang Keluar</span>
        </a>

        <a href="{{ route('peminjaman.index') }}" class="flex items-center px-4 py-3 {{ $isActive('peminjaman') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-box-arrow-up text-lg"></i>
            </div>
            <span class="text-sm font-bold">Peminjaman</span>
        </a>

        <a href="{{ route('pengembalian.index') }}" class="flex items-center px-4 py-3 {{ $isActive('pengembalian') }} group">
            <div class="w-8 flex justify-start">
                <i class="bi bi-box-arrow-up text-lg"></i>
            </div>
            <span class="text-sm font-bold">Pengembalian</span>
        </a>

    </nav>

    <div class="p-4 border-t border-gray-50">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
            class="w-full flex items-center px-4 py-3 text-gray-400 hover:text-red-500 hover:bg-red-50 
                   rounded-xl transition-all font-bold text-sm">
            
            <div class="w-8 flex justify-start">
                <i class="bi bi-box-arrow-left text-lg"></i>
            </div>
            Sign Out
        </button>
    </form>
</div>
</aside>
</body>
</html>
@vite('resources/css/app.css')


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Inventaris SMKN 2 Kota Mojokerto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #eef2ff, #ffffff);
        }
        .login-card {
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-600 rounded-2xl shadow-xl shadow-indigo-200 mb-4 transform rotate-3">
                <i class="bi bi-cpu text-white text-3xl"></i>
            </div>
            <h1 class="text-2xl font-black text-gray-800 tracking-tight uppercase leading-none">
                SMK NEGERI 2<br>
                <span class="text-indigo-600 text-lg">KOTA MOJOKERTO</span>
            </h1>
            <p class="text-gray-400 text-sm mt-2 font-medium">Sistem Informasi Inventaris Barang</p>
        </div>

        <div class="bg-white/80 login-card rounded-[2.5rem] p-10 shadow-[0_20px_50px_rgba(79,70,229,0.1)] border border-white/50">
            <h2 class="text-xl font-bold text-gray-800 mb-8 text-center">Selamat Datang Kembali</h2>

            @if(session('error'))
                <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-2xl text-sm font-bold animate-pulse">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-600 text-gray-400">
                            <i class="bi bi-person-fill text-lg"></i>
                        </div>
                        <input type="text" name="username" required 
                            class="w-full pl-12 pr-4 py-4 bg-gray-50/50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all shadow-inner text-gray-700 placeholder-gray-300"
                            placeholder="Masukkan username Anda">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-colors group-focus-within:text-indigo-600 text-gray-400">
                            <i class="bi bi-shield-lock-fill text-lg"></i>
                        </div>
                        <input type="password" name="password" required 
                            class="w-full pl-12 pr-4 py-4 bg-gray-50/50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all shadow-inner text-gray-700 placeholder-gray-300"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                    <span>Masuk ke Sistem</span>
                    <i class="bi bi-arrow-right-short text-2xl"></i>
                </button>
            </form>
        </div>

        <p class="text-center mt-10 text-gray-400 text-xs font-medium">
            &copy; 2026 IT STAFF SMK Negeri 2 Kota Mojokerto.<br>
            Semua Hak Dilindungi.
        </p>
    </div>

</body>
</html>
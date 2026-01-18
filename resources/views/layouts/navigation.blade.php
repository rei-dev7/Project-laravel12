<nav x-data="{ openMobile: false, openHistori: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT SIDE : MENU -->
            <div class="flex items-center space-x-8">

                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                   {{ request()->routeIs('dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Dashboard
                </a>

                <!-- Histori Dropdown -->
                <div class="relative">
                    <button
                        @click="openHistori = !openHistori"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                        {{ request()->is('histori/*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Histori
                        <i class="bi bi-chevron-down ml-1 text-xs"></i>
                    </button>

                    <!-- Dropdown -->
                    <div
                        x-show="openHistori"
                        @click.outside="openHistori = false"
                        x-transition
                        class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg z-50">

                        <a href="{{ route('histori.masuk') }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-xl">
                            <i class="bi bi-box-arrow-in-down text-green-600 mr-2"></i>
                            Barang Masuk
                        </a>

                        <a href="{{ route('histori.keluar') }}"
                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-xl">
                            <i class="bi bi-box-arrow-up text-red-600 mr-2"></i>
                            Barang Keluar
                        </a>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE : ADMIN -->
            <div class="hidden sm:flex items-center">
    <span class="text-sm font-semibold text-gray-700">
        {{ Auth::user()->username }}
    </span>
</div>


            <!-- HAMBURGER (MOBILE) -->
            <div class="flex items-center sm:hidden">
                <button @click="openMobile = !openMobile"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400
                               hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': openMobile }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !openMobile }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="openMobile" x-transition class="sm:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-3 space-y-2">

            <div class="text-sm font-semibold text-gray-700">
                Administrator
            </div>

            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-md text-base font-medium
               {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">
                Dashboard
            </a>

            <div class="border-t pt-2">
                <p class="text-sm font-semibold text-gray-500 px-3 mb-1">Histori</p>

                <a href="{{ route('histori.masuk') }}"
                   class="block px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-md">
                    Barang Masuk
                </a>

                <a href="{{ route('histori.keluar') }}"
                   class="block px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-md">
                    Barang Keluar
                </a>
            </div>

        </div>
    </div>
</nav>

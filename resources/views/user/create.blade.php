@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-200 max-w-2xl mx-auto px-6 py-6">

        {{-- HEADER --}}
        <div class="mb-8 py-4">
            <h2 class="text-3xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-person-plus-fill text-indigo-600 text-3xl"></i>
                <span>Tambah User Baru</span>
            </h2>

            <p class="text-gray-500 mt-2">
                Isi data berikut dengan lengkap untuk menambahkan user baru ke sistem.
            </p>
        </div>

        {{-- FORM --}}
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-6">
                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-1">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                       placeholder="Cth: Aldo Firdaus"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('nama_lengkap') border-red-500 @enderror">
                @error('nama_lengkap')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Username --}}
            <div class="mb-6">
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">
                    Username <span class="text-red-500">*</span>
                </label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                       placeholder="Username untuk login"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Role --}}
            <div class="mb-6">
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-1">
                    Role <span class="text-red-500">*</span>
                </label>
                <select id="role" name="role" required
                        class="w-full border border-gray-300 rounded-xl p-3 bg-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('role') border-red-500 @enderror">
                    <option value="" disabled {{ old('role') == null ? 'selected' : '' }}>Pilih Role User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staf" {{ old('role') == 'staf' ? 'selected' : '' }}>Staf</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                    Password <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password" name="password" required
                       placeholder="Minimal 6 karakter"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">
                    Konfirmasi Password <span class="text-red-500">*</span>
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       placeholder="Ulangi password"
                       class="w-full border border-gray-300 rounded-xl p-3 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-end space-x-4 mb-4 py-5">
                <a href="{{ route('user.index') }}"
                   class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-xl hover:bg-gray-300 transition shadow-sm">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-black bg-indigo-600 rounded-xl hover:bg-indigo-700 transition shadow-lg">
                    Simpan User
                </button>
            </div>

        </form>

    </div> {{-- END CARD --}}

</div>

@endsection
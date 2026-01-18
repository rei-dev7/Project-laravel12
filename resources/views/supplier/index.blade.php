@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')

<div class="w-full px-6 py-6">

    {{-- CARD WRAPPER --}}
    <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8 px-5">
            <h2 class="text-4xl font-extrabold text-gray-900 flex items-center space-x-3">
                <i class="bi bi-truck text-indigo-600 text-4xl"></i>
                <span>Data Supplier</span>
            </h2>

            <a href="{{ route('supplier.create') }}"
               class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-md">
                <i class="bi bi-plus-circle mr-2"></i>
                Tambah Supplier
            </a>
        </div>

        {{-- Search & Total --}}
        <div class="flex items-center justify-between mb-6 px-5">
            <div class="flex items-center bg-white px-5 py-2 rounded-xl border border-gray-300 shadow">
                <i class="bi bi-collection mr-2 text-indigo-600"></i>
                <span class="text-gray-700">
                    Total Data: <span class="font-bold text-indigo-700">{{ $suppliers->count() }}</span>
                </span>
            </div>
        </div>

        {{-- Table --}}
        <div class="w-full bg-white border border-gray-300 rounded-2xl shadow overflow-x-auto">

            <table class="w-full">
                <thead class="bg-indigo-600 text-white rounded-t-2xl">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @forelse($suppliers as $supplier)
                        <tr class="hover:bg-indigo-50 transition">

                            <td class="px-6 py-4">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $supplier->nama_supplier }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $supplier->telepon ?? '-' }}
                            </td>

                            <td class="px-6 py-4 max-w-xl">
                                {{ $supplier->alamat ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">

                                    <a href="{{ route('supplier.edit', $supplier->id_supplier) }}"
                                       class="px-4 py-2 rounded-lg bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition font-medium">
                                        Edit
                                    </a>

                                    <form action="{{ route('supplier.destroy', $supplier->id_supplier) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus supplier {{ $supplier->nama_supplier }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition font-medium">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-gray-500">
                                <i class="bi bi-emoji-frown text-4xl text-gray-300"></i>
                                <div class="mt-2 text-lg">Tidak ada data supplier</div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

    </div> {{-- END CARD --}}

</div>

@endsection

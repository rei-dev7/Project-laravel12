<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash; // Diperlukan untuk hashing password

class UserController extends Controller
{
    // READ: Menampilkan daftar user
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    // CREATE: Menampilkan form tambah user
    public function create()
    {
        return view('user.create');
    }

    // STORE: Menyimpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'nama_lengkap' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' mencari input 'password_confirmation'
            'role' => ['required', Rule::in(['admin', 'staf'])], // Sesuaikan role yang valid
        ]);

        User::create($request->all());

        return redirect()->route('user.index')
                         ->with('success', 'Data User baru berhasil ditambahkan!');
    }

    // EDIT: Menampilkan form edit user
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // UPDATE: Memperbarui data user
    public function update(Request $request, User $user)
    {
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'role' => ['required', Rule::in(['admin', 'staf'])],
            // Pastikan username unik, kecuali untuk user yang sedang diedit
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($user->id_user, 'id_user')],
        ];

        // Jika password diisi, validasi password baru
        if ($request->filled('password')) {
            $rules['password'] = 'nullable|string|min:6|confirmed';
        }

        $request->validate($rules);

        $data = $request->except('password');
        
        // Hash password baru jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return redirect()->route('user.index')
                         ->with('success', 'Data User berhasil diperbarui!');
    }

    // DELETE: Menghapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')
                         ->with('success', 'Data User berhasil dihapus!');
    }
}
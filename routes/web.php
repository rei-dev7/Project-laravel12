<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\KategoriTujuanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| AUTH / LOGIN (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

/*
|--------------------------------------------------------------------------
| ROUTE YANG WAJIB LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // redirect root ke dashboard
    Route::get('/', fn () => redirect('/dashboard'));

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/item/laporan', [ItemController::class, 'laporan'])->name('item.laporan');
    Route::get('/barangkeluar/laporan', [App\Http\Controllers\BarangKeluarController::class, 'laporan'])->name('barangkeluar.laporan');
    Route::get('/barangmasuk/laporan', [App\Http\Controllers\BarangMasukController::class, 'laporan'])->name('barangmasuk.laporan');
    Route::get('/peminjaman/laporan', [App\Http\Controllers\PeminjamanController::class, 'laporan'])->name('peminjaman.laporan');
 
    Route::get('/pengembalian/laporan/cetak', [PengembalianController::class, 'laporanCetak'])->name('pengembalian.laporan.cetak');
 
    
    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */
    Route::resources([
        'user'           => UserController::class,
        'item'           => ItemController::class,
        'supplier'       => SupplierController::class,
        'kategori'       => KategoriController::class,
        'subkategori'    => SubKategoriController::class,
        'kategoritujuan' => KategoriTujuanController::class,
    ]);

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI
    |--------------------------------------------------------------------------
    */
    Route::resources([
        'barangmasuk'  => BarangMasukController::class,
        'barangkeluar' => BarangKeluarController::class,
    ]);

    /*
    |--------------------------------------------------------------------------
    | HISTORI
    |--------------------------------------------------------------------------
    */
    Route::prefix('histori')->name('histori.')->group(function () {
        Route::get('/masuk', [HistoriController::class, 'barangMasuk'])
            ->name('masuk');

        Route::get('/keluar', [HistoriController::class, 'barangKeluar'])
            ->name('keluar');
    });

Route::resource('peminjaman', PeminjamanController::class);


Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');


Route::get('pengembalian', [PengembalianController::class, 'index'])
    ->name('pengembalian.index');

Route::get('pengembalian/{peminjaman}', [PengembalianController::class, 'create'])
    ->name('pengembalian.create');

Route::post('/pengembalian/{peminjaman}', 
    [PengembalianController::class, 'store']
)->name('pengembalian.store');

Route::get('pengembalian/detail/{id}', [PengembalianController::class, 'show'])
    ->name('pengembalian.show');


});

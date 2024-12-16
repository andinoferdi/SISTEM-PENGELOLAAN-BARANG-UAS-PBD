<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailPenerimaanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\DetailPengadaanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\DetailReturController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\KartuStokController;

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('satuan', SatuanController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('vendor', VendorController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('pengadaan', PengadaanController::class);
   Route::resource('detail_pengadaan', DetailPengadaanController::class);
   Route::resource('penerimaan', PenerimaanController::class);
   Route::resource('detail_penerimaan', DetailPenerimaanController::class);
   Route::resource('retur', ReturController::class);
   Route::resource('detail_retur', DetailReturController::class);
    Route::resource('margin_penjualan', MarginPenjualanController::class);
    Route::resource('penjualan', PenjualanController::class);
   Route::resource('detail_penjualan', DetailPenjualanController::class);
   Route::resource('kartu_stok', KartuStokController::class);
   Route::delete('/kartu_stok/{kartu_stok_id}', [KartuStokController::class, 'destroy'])->name('kartu_stok.destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KeranjangController;

Route::get('/', [BarangController::class, 'index'])->name('barang.index');

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/{barang}', [KeranjangController::class, 'store'])->name('keranjang.store');
Route::patch('/keranjang/{barang}', [KeranjangController::class, 'update'])->name('keranjang.update');
Route::delete('/keranjang/{barang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
Route::delete('/keranjang', [KeranjangController::class, 'clear'])->name('keranjang.clear');
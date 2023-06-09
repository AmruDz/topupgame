<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$user=TransaksiController::class;
Route::get('/', [$user, 'indexUser'])->name('tampilanProduk');
Route::get('/{id}', [$user, 'userPilihProduk'])->name('transaksi.userPilihProduk');

// Route::middleware('auth')->group(function () {
    $a=KategoriController::class;
    Route::get('/kategori', [$a, 'index'])->name('kategori');
    Route::get('/kategori/tambah-kategori', [$a, 'create'])->name('kategori.create');
    Route::post('/kategori', [$a, 'store'])->name('kategori.store');
    Route::get('/kategori/edit-kategori/{id}', [$a, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [$a, 'update'])->name('kategori.update');
    Route::get('/kategori/{id}', [$a, 'destroy'])->name('kategori.destroy');

    $b=ProdukController::class;
    Route::get('/produk', [$b, 'index'])->name('produk');
    Route::get('/produk/{id}/disable', [$b, 'disable'])->name('produk.disable');
    Route::get('/produk/{id}/enable', [$b, 'enable'])->name('produk.enable');
    Route::get('/produk/tambah-produk', [$b, 'create'])->name('produk.create');
    Route::post('/produk', [$b, 'store'])->name('produk.store');
    Route::get('/produk/edit-produk/{id}', [$b, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [$b, 'update'])->name('produk.update');
    Route::get('/produk/{id}', [$b, 'destroy'])->name('produk.destroy');

    $c=ItemController::class;
    Route::get('/item', [$c, 'index'])->name('item');
    Route::get('/item/{id}/disable', [$c, 'disable'])->name('item.disable');
    Route::get('/item/{id}/enable', [$c, 'enable'])->name('item.enable');
    Route::get('/item/tambah-item', [$c, 'create'])->name('item.create');
    Route::post('/item', [$c, 'store'])->name('item.store');
    Route::get('/item/edit-item/{id}', [$c, 'edit'])->name('item.edit');
    Route::put('/item/{id}', [$c, 'update'])->name('item.update');
    Route::get('/item/{id}', [$c, 'destroy'])->name('item.destroy');

    $d=TransaksiController::class;
    Route::get('/dashboard', [$d, 'index'])->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

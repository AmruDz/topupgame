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
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [TransaksiController::class, 'index'])->name('dashboard');

    Route::controller(KategoriController::class)->prefix("kategori")->group(function(){
        Route::get('', 'index')->name('kategori');
        Route::get('/tambah-kategori', 'create')->name('kategori.create');
        Route::post('', 'store')->name('kategori.store');
        Route::get('/edit-kategori/{id}', 'edit')->name('kategori.edit');
        Route::put('/{id}', 'update')->name('kategori.update');
        Route::get('/{id}', 'destroy')->name('kategori.destroy');
    });

    Route::controller(ProdukController::class)->prefix("produk")->group(function(){
        Route::get('', 'index')->name('produk');
        Route::get('/{id}/disable', 'disable')->name('produk.disable');
        Route::get('/{id}/enable', 'enable')->name('produk.enable');
        Route::get('/tambah-produk', 'create')->name('produk.create');
        Route::post('', 'store')->name('produk.store');
        Route::get('/edit-produk/{id}', 'edit')->name('produk.edit');
        Route::put('/{id}', 'update')->name('produk.update');
        Route::get('/{id}', 'destroy')->name('produk.destroy');
    });

    Route::controller(ItemController::class)->prefix("item")->group(function(){
        Route::get('', 'index')->name('item');
        Route::get('/{id}/disable', 'disable')->name('item.disable');
        Route::get('/{id}/enable', 'enable')->name('item.enable');
        Route::get('/tambah-item', 'create')->name('item.create');
        Route::post('', 'store')->name('item.store');
        Route::get('/edit-item/{id}', 'edit')->name('item.edit');
        Route::put('/{id}', 'update')->name('item.update');
        Route::get('/{id}', 'destroy')->name('item.destroy');
    });

    // Route::get(ProfileController::class)->prefix("profile")->group(function(){
    //     Route::get('/profile', 'edit')->name('profile.edit');
    //     Route::patch('/profile', 'update')->name('profile.update');
    //     Route::delete('/profile', 'destroy')->name('profile.destroy');
    // });
});

Route::controller(TransaksiController::class)->group(function(){

    Route::get('/', 'indexUser')->name('tampilanProduk');
    Route::get('/belanja/{nama_produk}', 'userPilihProduk')->name('transaksi.userPilihProduk');
    Route::view('/invoice', 'invoice');
});

require __DIR__.'/auth.php';

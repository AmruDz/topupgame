<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\item;
use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dashboard = transaksi::all();
        $banyaktransaksi = transaksi::count();
        $currentDate = Carbon::now()->format('Y-m-d');
        $transaksiHariIni = transaksi::whereDate('created_at', $currentDate)->count();

        return view('dashboard', compact('dashboard', 'banyaktransaksi', 'transaksiHariIni'));
    }

    public function indexUser()
    {
        $tampilanProduk = produk::where('status', 'enable')->get();
        return view('index', compact('tampilanProduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function userPilihProduk($id)
    {
        $pilihProduk = produk::findOrFail($id);
        $tampilanProduk = produk::where('status', 'enable')->get();
        $tampilanItem = $pilihProduk->item()->where('status', 'enable')->get();

        return view('tampilan_produk', compact('pilihProduk', 'tampilanProduk', 'tampilanItem'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}

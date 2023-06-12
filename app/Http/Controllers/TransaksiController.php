<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\item;
use App\Models\payment;
use App\Models\kategori;
use App\Models\produk;
use App\Console\Commands\GenerateInvoiceNumber;
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
    public function userPilihProduk($nama_produk)
    {
    $nama_produk = str_replace('-', ' ', $nama_produk);
    $pilihProduk = produk::where('nama_produk', $nama_produk)->first();
    $tampilanProduk = produk::where('status', 'enable')->get();
    $tampilanItem = $pilihProduk->item()->where('status', 'enable')->get();
    $item = item::where('status', 'enable')->get();
    $tampilanPayment = payment::where('status', 'enable')->get();

    return view('tampilan_produk', compact('pilihProduk', 'tampilanProduk', 'tampilanItem', 'tampilanPayment', 'item'));
    }

    public function invoice()
    {
    $tampilanInvoice = transaksi::all();
    $tampilanProduk = produk::where('status', 'enable')->get();
    return view('invoice', compact('tampilanInvoice',  'tampilanProduk'));
    }

    public function about()
    {
    $tampilanProduk = produk::where('status', 'enable')->get();
    return view('about', compact('tampilanProduk'));
    }

    public function contact()
    {
    $tampilanProduk = produk::where('status', 'enable')->get();
    return view('contact', compact('tampilanProduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'invoice' => 'required',
            'data' => 'required',
            'waktu' => 'required',
            'item_id' => 'required',
            'nomor_whatsapp' => 'required',
        ]);

        // Simpan data transaksi ke dalam tabel
        $transaksi = new Transaksi;
        $transaksi->invoice = $validatedData['invoice'];
        $transaksi->data = $validatedData['data'];
        $transaksi->waktu = $validatedData['waktu'];
        $transaksi->item_id = $validatedData['item_id'];
        $transaksi->status = 'success';
        $transaksi->total_pembayaran = $request->input('total_pembayaran');
        $transaksi->nomor_whatsapp = $validatedData['nomor_whatsapp'];
        $transaksi->save();

        return redirect()->route('invoice')->with('success', 'Transaksi berhasil.');
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
        
    }
}

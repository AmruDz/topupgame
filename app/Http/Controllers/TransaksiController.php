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

    public function pending($id)
    {
        $transaksi = transaksi::findOrFail($id);
        $transaksi->status = 'pending';
        $transaksi->update();

        return redirect()->route('dashboard')->with('info', 'Transaksi dalam pending');
    }

    public function success($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'success';
        $transaksi->update();

        $item = Item::findOrFail($transaksi->item_id);
        $item->stock -= 1;
        $item->save();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil.');
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

    public function invoice($invoice)
    {
    $invoice = str_replace('-', ' ', $invoice);
    $invoiceyangdipilih = transaksi::where('invoice', $invoice)->first();
    $tampilanInvoice = transaksi::all();
    $tampilanProduk = produk::where('status', 'enable')->get();
    $item = item::all();
    return view('invoice', compact('invoiceyangdipilih','tampilanInvoice',  'tampilanProduk', 'item'));
    }

    public function cariInvoice(Request $request)
    {
        $item = Item::all();
        $tampilanProduk = Produk::where('status', 'enable')->get();
        $keyword = $request->input('invoice_number');
        $transaksi = Transaksi::where('invoice', $keyword)->first();

        return view('cari_invoice', compact('tampilanProduk', 'item', 'transaksi'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('invoice_number');
        $transaksi = Transaksi::where('invoice', $keyword)->first();

        if ($transaksi) {
            return redirect()->route('cariInvoice', ['invoice_number' => $transaksi->invoice]);
        } else {
            return redirect()->back()->with('error', 'Invoice not found.');
        }
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
        $validatedData = $request->validate([
            'invoice' => 'required',
            'data' => 'required',
            'waktu' => 'required',
            'item_id' => 'required',
            'nomor_whatsapp' => 'required',
        ]);

        $transaksi = new Transaksi;
        $transaksi->invoice = $validatedData['invoice'];
        $transaksi->data = $validatedData['data'];
        $transaksi->waktu = $validatedData['waktu'];
        $transaksi->item_id = $validatedData['item_id'];
        $transaksi->status = 'paid';
        $transaksi->total_pembayaran = $request->input('total_pembayaran');

        if ($request->has('total_pembayaran')) {
            $totalPembayaran = $request->input('total_pembayaran');
            $transaksi->total_pembayaran = str_replace(',', '', $totalPembayaran);
        }

        $transaksi->nomor_whatsapp = $validatedData['nomor_whatsapp'];
        $transaksi->save();

        return redirect()->route('invoice', ['invoice' => $transaksi->invoice])->with('success', 'Transaksi berhasil.');
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

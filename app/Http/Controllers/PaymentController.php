<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payment = payment::all();
        $banyakpayment = payment::count();
        $paymentenable = payment::where('status', 'enable')->count();
        $paymentdisable = payment::where('status', 'disable')->count();

        return view('payment', compact('payment', 'banyakpayment', 'paymentenable', 'paymentdisable'));
    }

    public function disable($id)
        {
            $payment = payment::findOrFail($id);
            $payment->status = 'disable';
            $payment->update();

            return redirect()->route('payment')->with('success', 'payment berhasil dinonaktifkan');
        }

    public function enable($id)
        {
            $payment = payment::findOrFail($id);
            $payment->status = 'enable';
            $payment->update();

            return redirect()->route('payment')->with('success', 'payment berhasil diaktifkan');
        }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payment = payment::all();
        return view('tambah_payment', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_payment' => 'required',
            'fee' => 'required',
            'foto' => 'required|image|max:2048',
        ]);

        $payment = new payment;
        $payment->nama_payment = $validatedData['nama_payment'];
        $payment->fee = $validatedData['fee'];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/payment');
            $fotoPath = str_replace('public/', '', $fotoPath);
            $payment->foto = $fotoPath;
        }

        $payment->save();

        return redirect()->route('payment')->with('success', 'Payment berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = payment::findOrFail($id);
        return view('edit_payment', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required',
            'nama_payment' => 'required',
            'fee' => 'required',
        ]);

        $payment = payment::findOrFail($id);
        if ($request->hasFile('foto')) {
            $existingFoto = $payment->foto;
            if ($existingFoto && Storage::exists('public/' . $existingFoto)) {
                Storage::delete('public/' . $existingFoto);
            }

            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/payment');
            $fotoPath = str_replace('public/', '', $fotoPath);
            $payment->foto = $fotoPath;
        }
        $payment->update($request->all());


        return redirect()->route('payment')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payment')->with('success', 'payment berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        return view('kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = kategori::all();
        return view('tambah_kategori', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = new kategori;
        $kategori->nama_kategori = $validatedData['nama_kategori'];

        $kategori->save();

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = kategori::findOrFail($id);
        return view('edit_kategori', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = kategori::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $kategori = kategori::findOrFail($id);

    if ($kategori->produk()->exists()) {
        return redirect()->route('kategori')->with('error', 'Tidak dapat menghapus kategori yang memiliki produk terkait.');
    }

    $kategori->delete();

    return redirect()->route('kategori')->with('success', 'Kategori berhasil dihapus');
    }
}

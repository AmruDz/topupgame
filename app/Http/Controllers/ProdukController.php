<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = produk::all();

        return view('produk', compact('produk'));
    }


    public function disable($id)
    {
        $produk = produk::findOrFail($id);
        $produk->status = 'disable';
        $produk->update();

        return redirect()->route('produk')->with('success', 'Produk berhasil dinonaktifkan');
    }

    public function enable($id)
    {
        $produk = produk::findOrFail($id);
        $produk->status = 'enable';
        $produk->update();

        return redirect()->route('produk')->with('success', 'Produk berhasil diaktifkan');
    }

    public function create()
    {
        $produk = produk::all();
        $kategori = kategori::all();
        return view('tambah_produk', compact('produk', 'kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|max:2048',
        ]);

        $produk = new produk;
        $produk->kategori_id = $validatedData['kategori_id'];
        $produk->nama_produk = $validatedData['nama_produk'];
        $produk->deskripsi = $validatedData['deskripsi'];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/product');
            $fotoPath = str_replace('public/', '', $fotoPath);
            $produk->foto = $fotoPath;
        }

        $produk->save();

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = produk::findOrFail($id);
        $kategori = kategori::all();
        return view('edit_produk', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|max:2048',
        ]);

        $produk = produk::findOrFail($id);

        if ($request->hasFile('foto')) {
            $existingFoto = $produk->foto;
            if ($existingFoto && Storage::exists('public/' . $existingFoto)) {
                Storage::delete('public/' . $existingFoto);
            }

            $foto = $request->file('foto');
            $fotoPath = $foto->store('public/product');
            $fotoPath = str_replace('public/', '', $fotoPath);
            $produk->foto = $fotoPath;
        }

        $produk->update($request->all());

        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = produk::findOrFail($id);

        if ($produk->item()->exists()) {
            return redirect()->route('produk')->with('error', 'Tidak dapat menghapus produk yang memiliki item terkait.');
        }

        if ($produk->foto) {
            $fotoPath = 'public/' . $produk->foto;
            Storage::delete($fotoPath);
        }

        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus');
    }


}

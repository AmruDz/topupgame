<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\produk;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $item = item::all();
        $banyakitem = item::count();
        $itemenable = item::where('status', 'enable')->count();
        $itemdisable = item::where('status', 'disable')->count();

        return view('item', compact('item', 'banyakitem', 'itemenable', 'itemdisable'));
    }

    public function disable($id)
        {
            $item = item::findOrFail($id);
            $item->status = 'disable';
            $item->update();

            return redirect()->route('item')->with('success', 'Item berhasil dinonaktifkan');
        }

    public function enable($id)
        {
            $item = item::findOrFail($id);
            $item->status = 'enable';
            $item->update();

            return redirect()->route('item')->with('success', 'Item berhasil diaktifkan');
        }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = item::all();
        $produk = produk::all();
        return view('tambah_item', compact('item', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produk_id' => 'required',
            'nama_item' => 'required',
            'stock' => 'required',
            'harga_modal' => 'required',
            'harga_jual' => 'required'
        ]);

        $item = new item;
        $item->produk_id = $validatedData['produk_id'];
        $item->nama_item = $validatedData['nama_item'];
        $item->stock = $validatedData['stock'];
        $item->harga_modal = $validatedData['harga_modal'];
        $item->harga_jual = $validatedData['harga_jual'];

        $item->save();

        return redirect()->route('item')->with('success', 'Item berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = item::findOrFail($id);
        $produk = produk::all();
        return view('edit_item', compact('item', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'produk_id' => 'required',
            'nama_item' => 'required',
            'stock' => 'required',
            'harga_modal' => 'required',
            'harga_jual' => 'required'
        ]);

        $item = item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('item')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = item::findOrFail($id);
        $item->delete();

        return redirect()->route('item')->with('success', 'Item berhasil dihapus');
    }
}

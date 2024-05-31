<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $produks = Product::with('category')->get();
        return view('pages.product.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('pages.product.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required|numeric',
        ]);

        Produk::create($request->all());
        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil dibuat.');
    }

    public function show(Produk $produk)
    {
        return view('pages.product.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('pages.product.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'harga_produk' => 'required|numeric',
        ]);

        $produk->update($request->all());
        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}

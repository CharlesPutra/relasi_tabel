<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = kategori::all();
        $produk = Produk::all();
        $katdata = $kategoris->count();
        $prodata = $produk->count();
        return view('kategori.index', compact('kategoris','produk','katdata','prodata'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);
    
        kategori::create($request->all());
    
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = kategori::findOrFail($id);
        
        $produks = $show->produks;
        return view('kategori.show', compact('show','produks'));
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoriedit = kategori::findOrFail($id);
        return view('kategori.edit', compact('kategoriedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $kategoriupdate = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);
        kategori::where('id',$id)->update($kategoriupdate);
        return redirect()->route('kategori.index')->with('success','Kategori Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        kategori::where('id',$id)->delete();
        return redirect()->route('kategori.index')->with('success','Kategori Berhasil Di Hapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = kategori::all();
        $produk = Produk::all();
        $datapro = $produk->count();
        $datakat = $kategoris->count();
        return view('produk.create', compact('kategoris','produk','datapro','datakat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
       $validated = $request->validate([
            'nama'=> 'required',
            'harga'=>'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);
       //  dd($request->all());
        if($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('img','public');
        }
     
        Produk::create($validated);
      // Produk::create([
       // 'nama' => $request->nama,
       // 'harga' => $request->harga,
       // 'kategori_id' => $request->kategori_id,
       // 'deskripsi' => $request->deskripsi,
       // 'image' => $request->image,
   // ]);

        return redirect()->route('produk.index')->with('success','Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $show = Produk::findOrFail($id);
      return view('modal.show', compact('show'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produkedit = Produk::findOrFail($id);
        $kategoris = kategori::all();
        return view('produk.edit', compact('produkedit','kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'=> 'required',
            'harga'=>'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi'=>'required',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('img','public');
        }

        Produk::where('id',$id)->update($validated);
     
        return redirect()->route('produk.index')->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Produk::where('id',$id)->delete();
        return redirect()->route('produk.index')->with('success','Data Berhsil Di Hapus');
    }
}

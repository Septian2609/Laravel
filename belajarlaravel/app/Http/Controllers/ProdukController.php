<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;


class ProdukController extends Controller
{
	public function produk(){
		$data_produk = Produk::all();
    	return view('produk.index', ['data_produk' => $data_produk]);
	}

	public function create(Request $request){
		$produk                                = new \App\Models\Produk();
        $produk->nama_produk                   = $request->nama_produk;
        $produk->diskripsi 					   = $request->diskripsi;
        $produk->jumlah 					   = $request->jumlah;
        $produk->harga		                   = $request->harga;
        $produk->save();

        return redirect('/produk');
	}

    public function delete($id)
    {
        $produk = \App\Models\Produk::find($id);
        $produk -> delete('$produk');
        return back();
    }

    public function edit($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        return response()->json($produk);
    }

    public function update(Request $request)
    {
        $produk = \App\Models\Produk::find($request->id);
        $produk -> update($request->all());
        return redirect('/produk');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProdukRequest;
use App\Http\Requests\updateProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public $pageTitle = 'Data Produk';
    public function index(){
        $query = Produk::query();
        $perPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $pageTitle = $this->pageTitle;

        $query->with('kategori:id,nama_kategori');

        if($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        $produk = $query->orderBy('created_at', 'DESC')->paginate($perPage)->appends(request()->query());
        confirmDelete('Menghapus Data Produk Akan Menghapus Semua Varian Yang Ada, Lanjutkan ?');

        return view('produk.index', compact('pageTitle', 'produk'));
    }

    public function store(storeProdukRequest $request){
        $produk = Produk::create([
           'nama_produk'        => $request->nama_produk, 
           'deskripsi_produk'   => $request->deskripsi_produk,
           'kategori_produk_id' => $request->kategori_produk_id,
        ]);
        toast()->success('Produk Berhasil Ditambahkan');
        return redirect()->route('master-data.produk.show', $produk->id);
    }

    public function update(updateProdukRequest $request, Produk $produk){
        $produk->update([
           'nama_produk' => $request->nama_produk,
           'deskripsi_produk'   => $request->deskripsi_produk,
           'kategori_produk_id' => $request->kategori_produk_id 
        ]);
        toast()->success('Produk Berhasil Ditambahkan');
        return redirect()->route('master-data.produk.index');
    }

    public function show(Produk $produk){
        $pageTitle = $this->pageTitle;
        return view('produk.show', compact('produk', 'pageTitle'));
    }

    public function destroy(Produk $produk){
        $produk->delete();
        toast()->success('Produk Berhasil Dihapus');
        return redirect()->route('master-data.produk.index');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriProdukRequest;
use App\Http\Requests\updateKategoriRequest;
use App\Http\Requests\updateKategoriProdukRequest;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public $pageTitle = 'KategoriProduct';
    public function index(){
        $pageTitle = $this->pageTitle;
        $perpage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $query = KategoriProduk::query();

        if($search) {
            $query->where('nama_kategori', 'like', '%' . $search . '%');
        }
        
        $kategori = $query->paginate($perpage)->appends(request()->query());
        confirmDelete('Hapus Kategori Tidak Bisa Dibatalkan, Lanjutkan ?');
        return view('kategori-produk.index', compact('pageTitle', 'kategori'));
    }

    public function store(storeKategoriProdukRequest $request){
        KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori 
        ]);
        toast()->success('Kategori Produk Berhasil Ditambahkan');
        return redirect()->route('master-data.kategori-produk.index');
    }

    public function update(updateKategoriProdukRequest $request, KategoriProduk $kategoriProduk){
        $kategoriProduk->nama_kategori = $request->nama_kategori;
        $kategoriProduk->save();
        toast()->success('Kategori Produk Berhasil Diubah');
        return redirect()->route('master-data.kategori-produk.index');
    }

    public function destroy(KategoriProduk $kategoriProduk){
        $kategoriProduk->delete();
        toast()->success('Kategori Produk Berhasil Dihapus');
        return redirect()->route('master-data.kategori-produk.index');
    }
}
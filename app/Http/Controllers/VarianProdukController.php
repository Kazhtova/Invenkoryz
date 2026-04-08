<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeVarianProdukRequest;
use App\Http\Requests\updateVarianProdukRequest;
use App\Http\Resources\KartuResource;
use App\Models\KartuStok;
use App\Models\LaporanKenaikanHarga;
use App\Models\VarianProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VarianProdukController extends Controller
{
    public function store(storeVarianProdukRequest $request) {
        $fileName = time() . '.' . $request->file('gambar_varian')->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('varian-produk', $request->file('gambar_varian'), $fileName);
        VarianProduk::create([
           'produk_id'      => $request->produk_id,
           'nomor_sku'      => VarianProduk::generateNomorSku(),
           'nama_varian'    => $request->nama_varian,
           'harga_varian'   => $request->harga_varian,
           'stok_varian'    => $request->stok_varian,
           'gambar_varian'  => $fileName
        ]);

        return response()->json([
            'message' => 'Data Berhasil Disimpan'
        ]);
    }

    public function update(updateVarianProdukRequest $request, $varian_produk){
        
        $isAdjustment = false;
        $varian = VarianProduk::findOrFail($varian_produk);

        $existKenaikanHarga = LaporanKenaikanHarga::where('nomor_sku', $varian->nomor_sku)->where('is_confirmed', false)->first();

        if($request->stok_varian != $varian->stok_varian) {
            $isAdjustment = true;
        }

        $fileName = $varian->gambar_varian;
        
        if ($request->file('gambar_varian')){
            Storage::disk('public')->delete('varian-produk/' . $varian->gambar_varian);
            $fileName = time() . '.' . $request->file('gambar_varian')->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('varian-produk', $request->file('gambar_varian'), $fileName);
        }

        $varian->update([
           'nama_varian'      => $request->nama_varian,
           'harga_varian'     => $request->harga_varian,
           'stok_varian'      => $request->stok_varian,
           'gambar_varian'    => $fileName
        ]);

        if($existKenaikanHarga && $request->harga_varian >= $existKenaikanHarga->harga_beli) {
            $existKenaikanHarga->update([
                'is_confirmed'  => true
            ]);
        }

        if($isAdjustment){
            KartuStok::create([
                'jenis_transaksi'   => 'adjustment',
                'nomor_sku'         => $varian->nomor_sku,
                'stok_akhir'        => $varian->stok_varian,
                'petugas'           => Auth::user()->name
            ]);
        }

        return response()->json([
            'message'   => 'Data Berhasil Diupdate'
        ]);
    }

    public function destroy($varian_produk){
        $varian = VarianProduk::findOrFail($varian_produk);
        Storage::disk('public')->delete('varian-produk/' . $varian->gambar_varian);
        $varian->delete();
        toast()->success('Data Berhasil Dihapus');
        return redirect()->route('master-data.produk.show', $varian->produk_id);
    }

    public function getAllVarianJson(){
        $search = request()->query('search');
        $varians = VarianProduk::with('produk')
        ->where(function($query) use ($search) {
           $query->where('nama_varian', 'like', '%' . $search . '%')
           ->orWhere('nomor_sku', 'like', '%' . $search . '%')
           ->orWhereHas('produk', function ($query) use ($search) {
                $query->where('nama_produk', 'like', '%' . $search . '%');
           }); 
        })->get()->map(function ($q) {
            return [
              'id'          => $q->id,
              'text'        => $q->produk->nama_produk . " - " . $q->nama_varian,
              'harga'       => $q->harga_varian,
              'stok'        => $q->stok_varian,
              'nomor_sku'   => $q->nomor_sku
            ];
        });
        return response()->json($varians);
    }
}
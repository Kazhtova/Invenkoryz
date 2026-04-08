<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeriodeStokOpnameRequest;
use App\Http\Requests\UpdatePeriodeStokOpnameRequest;
use App\Models\ItemStokOpname;
use App\Models\PeriodeStokOpname;
use App\Models\VarianProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodeStokOpnameController extends Controller
{
    public $pageTitle = "Periode Stok Opname";
    
    public function index(){
        confirmDelete('Menghapus Periode Akan Menghapus Data Opname Yang Sudah Ada, Lanjutkan Untuk Menghapuskan');
        $pageTitle = $this->pageTitle;
        $dataPeriode = PeriodeStokOpname::orderBy('created_at', 'DESC')->get()->map(function ($q){
            $tanggalMulai = Carbon::parse($q->tanggal_mulai)->locale('id')->translatedFormat('d M Y');
            $tanggalSelesai = Carbon::parse($q->tanggal_selesai)->locale('id')->translatedFormat('d M Y');
            $periode = $tanggalMulai . ' s/d ' . $tanggalSelesai;
            return [
             'id'                   => $q->id,
             'periode'              => $periode,
             'is_active'            => $q->is_active,
             'is_completed'         => $q->is_completed,
             'jumlah_barang'        => $q->jumlah_barang,
             'jumlah_barang_sesuai' => ItemStokOpname::jumlahDilaporkan($q->id, 'sesuai'),
             'jumlah_barang_selisih'=> ItemStokOpname::jumlahDilaporkan($q->id, 'selisih')
            ];
        });
        return view('stok-opname.periode.index', compact('pageTitle', 'dataPeriode'));
    }

    public function store(StorePeriodeStokOpnameRequest $request){
        $isActive = $request->is_active ? true : false;
        $varian = VarianProduk::all();
        $newPeriode = PeriodeStokOpname::create([
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_selesai'   => $request->tanggal_selesai,
            'is_active'         => $isActive,
            'jumlah_barang'     => count($varian)
        ]);

        foreach ($varian as $item) {
            ItemStokOpname::create([
               'periode_stok_opname_id' => $newPeriode->id,
               'nomor_sku'              => $item->nomor_sku,
               'jumlah_stok'            => $item->stok_varian
            ]);
        }

        PeriodeStokOpname::where('is_active', true)
            ->where('id', '!=', $newPeriode)
            ->update(['is_active' => false]);
        
        toast()->success('Periode Stok Opname Berhasil Ditambahkan');
        return redirect()->route('stok-opname.periode.index');
        
    }

    public function update(UpdatePeriodeStokOpnameRequest $request, $id ){
        $isActive = $request->is_active ? true : false;
        
        $periode = PeriodeStokOpname::findOrFail($id);
        $periode->update([
           'tanggal_mulai'      => $request->tanggal_mulai,
           'tanggal_selesai'    => $request->tanggal_selesai,
           'is_active'          => $isActive 
        ]);

        if($request->is_active){
            PeriodeStokOpname::where('is_active', true)
            ->where('id', '!=', $id)
            ->update(['is_active' => false]);
        }
    }

    public function destroy($id){
        $periode = PeriodeStokOpname::findOrFail($id);
        
        if($periode->is_active){
            toast()->error('Periode Stok Opname Sedang Aktif, Tidak Dapat Dihapus');
            return redirect()->route('stok-opname.periode.index');
        }
        
        $periode->delete();

        toast()->success('Periode Stok Opname Berhasil Dihapus');
        return redirect()->route('stok-opname.periode.index');
    }

    public function show($periode){
        $pageTitle = $this->pageTitle;
        $dataPeriode = PeriodeStokOpname::findOrFail($periode);
        $tanggalMulai = Carbon::parse($dataPeriode->tanggal_mulai)->locale('id')->translatedFormat('D M Y');
        $tanggalSelesai = Carbon::parse($dataPeriode->tanggal_selesai)->locale('id')->translatedFormat('D M Y');
        $periode = $tanggalMulai . ' s/d ' . $tanggalSelesai;
        $dataPeriode['periode'] = $periode;

        $dataPeriode['jumlah_barang_sesuai'] = ItemStokOpname::jumlahDilaporkan($dataPeriode->id, 'sesuai');
        $dataPeriode['jumlah_barang_selisih'] = ItemStokOpname::jumlahDilaporkan($dataPeriode->id, 'selisih');
        $dataPeriode['items'] = $dataPeriode->items->map(function ($q){
            $q->setAttribute('produk', $q->varian->produk->nama_produk . ' ' . $q->varian->nama_varian);
            return $q;
        });
        return view('stok-opname.periode.show', compact('pageTitle', 'dataPeriode'));
    }
}
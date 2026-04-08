<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateInputStokOpnameRequest;
use App\Models\ItemStokOpname;
use App\Models\PeriodeStokOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputStokOpnameController extends Controller
{
    public $pageTitle = "Input Laporan Stok Opname", $activePeriode = null, $items = null;
    
    public function __construct()
    {
        $periode = PeriodeStokOpname::where('is_active', true)->first()->id;
        $this->activePeriode = $periode;
        $this->items = ItemStokOpname::with('varian')->where('periode_stok_opname_id', $this->activePeriode)->get()->map(function($q){
            $produk = $q->varian->produk->nama_produk . ' ' . $q->varian->nama_varian;
            $q->setAttribute('produk', $produk);
            return $q;
        });
    }

    public function create(){
        $pageTitle = $this->pageTitle;
        $items = $this->items;
        return view('stok-opname.input.create', compact('pageTitle', 'items'));
    }

    public function update(UpdateInputStokOpnameRequest $request, $id){
        $item = ItemStokOpname::find($id);
        $isSelisih = $request->jumlah_dilaporkan != $item->jumlah_stok;

        $item->update([
           'jumlah_dilaporkan'      => $request->jumlah_dilaporkan,
           'status'                 => $isSelisih ? 'selisih' : 'sesuai',
           'keterangan'             => $request->keterangan,
           'petugas'                => Auth::user()->name
        ]);
        $itemStopOpname = ItemStokOpname::where('periode_stok_opname_id', $this->activePeriode)->where('status', 'belum dilaporkan')->count();
        if($itemStopOpname == 0){
            PeriodeStokOpname::where('id', $this->activePeriode)->update(['is_completed' => true]);
        }
        
        toast()->success('Item Stok Berhasil Dilaporkan');
        return redirect()->route('stok-opname.input-data.create');

    }
}
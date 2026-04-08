<?php

namespace App\Http\Controllers;

use App\Models\KartuStok;
use App\Models\TransaksiRetur;
use App\Models\TransaksiReturItem;
use App\Models\VarianProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiReturController extends Controller
{
    public $pageTitle = 'Transaksi Retur';
    
    public function index(){
        $pageTitle = $this->pageTitle;
        $search = request()->query('search');
        $perPage = request()->query('perPage') ?? 10;

        $query = TransaksiRetur::query();

        if($search){
            $query->where('nomor_sku', 'like', '%' . $search . '%')
            ->orWhereHas('transaksi', function($q) use ($search){
                $q->where('nomor_transaksi', 'like', '%' . $search . '%')
                    ->orWhere('pengirim', 'like', '%' . $search . '%');                
                });
        }

        $retur = $query->orderBy('created_at', 'DESC')->paginate($perPage)->appends(request()->query());
        return view('transaksi-retur.index', compact('pageTitle', 'retur'));
    }

    public function create(){
        $pageTitle = $this->pageTitle;
        return view('transaksi-retur.create', compact('pageTitle'));
    }

    public function store(Request $request){
        $nomorTransaksi = $request->nomor_transaksi;
        $items = $request->items;
        $nomorRetur = TransaksiRetur::generateNomorRetur();

        $transaksi = TransaksiRetur::create([
           'nomor_retur'    => $nomorRetur,
           'nomor_transaksi'=> $nomorTransaksi,
           'jumlah_barang'  => count($items),
           'jumlah_harga'    => array_sum(array_column($items, 'subTotal')),
           'petugas'        => Auth::user()->name 
        ]);

        foreach ($items as $item){
            $varian = VarianProduk::where('nomor_sku', $item['nomor_sku'])->first();
            TransaksiReturItem::crete([
               'transaksi_retur_id' => $transaksi->id,
               'produk'             => $varian->produk->nama_produk,
               'varian'             => $varian->nama_varian,
               'nomor_batch'        => $item['batch'],
               'nomor_sku'          => $item['nomor_sku'],
               'qty'                => $item['qty'],
               'sub_total'           => $item['subTotal'],
               'harga'              => $item['harga'],
               'note'               => $item['note']
            ]);
            $varian->decrement('stok_varian', $item['qty']);
            $varian->save();
            KartuStok::create([
                'nomor_transaksi'   => $nomorRetur,
                'jenis_transaksi'   => 'retur',
                'nomor_sku'         => $item['nomor_sku'],
                'jumlah_keluar'     => $item['qty'],
                'stok_akhir'        => $varian->stok_varian,
                'petugas'           => Auth::user()->name
            ]);
        }
        toast()->success('Transaksi Retur Berhasil Disimpan');
        return response()->json([
            'success'   => true,
            'redirect_url'  => route('transaksi-retur.create') 
        ]);
    }

    public function show($nomor_retur){
        $pageTitle = "Detail " . $this->pageTitle;
        $transaksi = TransaksiRetur::with('transaksi', 'items')->where('nomor_retur', $nomor_retur)->first();
        $transaksi->tanggal_retur = Carbon::parse($transaksi->created_at)->locale('id')->translatedFormat('l, d F Y');
        $transaksi->jumlah_barang = $transaksi->items->sum('qty');
        
        return view('transaksi-retur.show', compact('transaksi', 'pageTitle'));
    }
}   
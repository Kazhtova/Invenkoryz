<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeTransaksiMasukRequest;
use App\Models\KartuStok;
use App\Models\LaporanKenaikanHarga;
use App\Models\Transaksi;
use App\Models\VarianProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
    
class TransaksiMasukController extends Controller
{
    public $pageTitle = 'Transaksi Masuk';
    public $jenisTransaksi = 'pemasukan';

    public function index(){
        $pengirim = request()->query('pengirim');
        $tanggalAwal = request()->query('tanggal_awal');
        $tanggalAkhir = request()->query('tanggal_akhir');
        $perPage = request()->query('perPage', 10);
        
        $query = Transaksi::query();
        $query->orderBy('created_at', 'DESC');
        $query->where('jenis_transaksi', $this->jenisTransaksi);

        if($pengirim){
            $query->where('pengirim', 'like', '%' . $pengirim . '%');
        }
        
        if($tanggalAwal && $tanggalAkhir){
            $tanggalAwal = Carbon::parse($tanggalAwal)->startOfDay();
            $tanggalAkhir = Carbon::parse($tanggalAkhir)->endOfDay();
            $query->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir]);
        }

        $transaksi = $query->paginate($perPage)->appends(request()->query());
    
        $pageTitle = $this->pageTitle;
        return view('transaksi-masuk.index', compact('pageTitle', 'transaksi'));
    }
    public function create(){
        $pageTitle = $this->pageTitle;
        return view('transaksi-masuk.create', compact('pageTitle'));
    }

    public function show($nomor_transaksi){
        $pageTitle = "Detail " . $this->pageTitle;
        $transaksi = Transaksi::with('items')->where('nomor_transaksi', $nomor_transaksi)->firstOrFail();
        $transaksi->formated_date = Carbon::parse($transaksi->created_at)->locale('id')->translatedFormat('l, d F Y');
        return view('transaksi-masuk.show', compact('transaksi', 'pageTitle'));
    }

    public function store(storeTransaksiMasukRequest $request){
        $validator = Validator::make($request->all(), $request->rules(),$request->messages());
        if($validator->fails()){
            return response()->json([
                'success'   => false,
                'errors'    => $validator->errors()
            ], 422);
        }

        $nomorTransaksi = Transaksi::generateNomorTransaksi($this->jenisTransaksi);
        $items = $request->items;

        $transaksi = Transaksi::create([
            'nomor_transaksi'   => $nomorTransaksi,
            'jenis_transaksi'   => $this->jenisTransaksi,
            'jumlah_barang'     => count($items),
            'total_harga'       => array_sum(array_column($items, 'subTotal')),
            'keterangan'        => $request->keterangan,
            'petugas'           => Auth::user()->name,
            'pengirim'          => $request->pengirim,
            'kontak'            => $request->kontak
        ]);

        foreach ($items as $item) {
            $query = explode('-', $item['text']);
            $varian = VarianProduk::where('nomor_sku', $item['nomor_sku'])->first();

            if($item['harga'] > $varian->harga_varian){
                LaporanKenaikanHarga::create([
                   'nomor_transaksi'        => $nomorTransaksi,
                   'nomor_batch'            => $item['nomor_batch'],
                   'nomor_sku'              => $item['nomor_sku'],
                   'harga_lama'             => $varian->harga_varian,
                   'harga_beli'             => $varian['harga'],
                   'kenaikan_harga'         => $item['harga'] - $varian->harga_varian,
                   'jumlah_barang'          => $item['qty']
                ]);
            }
            
            $transaksi->items()->create([
               'transaksi_id'   => $transaksi->id,
               'produk'         => $query[0],
               'varian'         => $query[1],
               'nomor_batch'    => $item['nomor_batch'],
               'qty'            => $item['qty'],   
               'harga'          => $item['harga'],  
               'sub_total'      => $item['subTotal'],
               'nomor_sku'      => $item['nomor_sku'],   
            ]);
            $varian->increment('stok_varian', $item['qty']);
            KartuStok::create([
               'nomor_transaksi'        => $nomorTransaksi,
               'jenis_transaksi'        => 'in',
               'nomor_sku'              => $item['nomor_sku'],
               'jumlah_masuk'           => $item['qty'],
               'stok_akhir'             => $varian->stok_varian,
               'petugas'                => Auth::user()->name 
            ]);
        }
        toast()->success('Transaksi Masuk Berhasil Ditambahkan');
        return response()->json([
           'success'        => true,
           'redirect_url'   => route('transaksi-masuk.create')
        ]);
    }
}
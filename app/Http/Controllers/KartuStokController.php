<?php

namespace App\Http\Controllers;

use App\Exports\ExportLaporanKartuStok;
use App\Http\Resources\KartuStokResource;
use App\Models\KartuStok;
use App\Models\VarianProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KartuStokController extends Controller
{
    public function kartuStok($nomor_sku){
        $query = KartuStok::where('nomor_sku', $nomor_sku)->orderby('created_at', 'DESC')->paginate(1);
        return KartuStokResource::collection($query);
    }

    public function exportLaporan(Request $request){
        $request->validate([
            'tanggal_awal'  => 'required',
            'tanggal_akhir' => 'required|after_or_equal:tanggal_awak',
            'nomor_sku'     => 'required'
        ]);

        $tanggalAwal = Carbon::parse($request->tanggal_awal)->startOfDay();
        $tanggalAkhir = Carbon::parse($request->tanggal_akhir)->endOfDay();
        $nomorSku = $request->nomor_sku;
        $jenisTransaksi = $request->jenis_transaksi;
        $varian = VarianProduk::where('nomor_sku', $nomorSku)->first();

        $query = KartuStok::where('nomor_sku', $nomorSku)->where('jenis_transaksi', $jenisTransaksi)->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
        ->orderBy('created_at', 'DESC')->get();
        
        return Excel::download(new ExportLaporanKartuStok($query, $varian, $tanggalAwal, $tanggalAkhir), 'laporan-kartu-stok.xlsx');
    }
}
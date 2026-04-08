<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStokOpname extends Model
{
    protected $guarded = ['id'];

    public function periodeStokOpname(){
        return $this->belongsTo(PeriodeStokOpname::class, 'periode_stok_opname_id');
    }

    public function varian(){
        return $this->belongsTo(VarianProduk::class, 'nomor_sku', 'nomor_sku');
    }

    public function jumlahDilaporkan($periode, $status){
        $jumlah = ItemStokOpname::where('periode_stok_opname_id', $periode)->where('status', $status)->count();
        return $jumlah;
    } 
}
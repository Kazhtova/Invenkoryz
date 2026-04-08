<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKenaikanHarga extends Model
{
    protected $guarded = ['id'];
    
    public function varian(){
        return $this->belongsTo(VarianProduk::class, 'nomor_sku', 'nomor_sku'); 
    }
}
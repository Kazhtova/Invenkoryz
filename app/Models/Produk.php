<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_produk', 'deskripsi_produk', 'kategori_produk_id'];
    public function kategori(){
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }

    public function varian(){
        return $this->hasMany(VarianProduk::class, 'produk_id');
    }
}
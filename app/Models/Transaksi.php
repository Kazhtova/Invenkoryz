<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'nomor_transaksi',
        'jenis_transaksi',
        'jumlah_barang',
        'total_harga',
        'keterangan',
        'petugas',
        'pengirim',
        'penerima',
        'kontak',
    ];

    public function items(){
        return $this->hasMany(TransaksiItems::class, 'transaksi_id');
    }
    
    public static function generateNomorTransaksi($jenisTransaksi){
        $prefix = $jenisTransaksi === 'pemasukan' ? 'PM' : 'PG';
        $date = date('Ymd');
        $lastTransaksi = self::where('nomor_transaksi', 'like', $prefix . $date . '%')
        ->orderBy('nomor_transaksi', 'desc')
        ->first();
        $nomor = $lastTransaksi ? (int) substr($lastTransaksi->nomor_transaksi, -6) + 1 : 1;
        $nomor = str_pad($nomor, 6, '0', STR_PAD_LEFT);
        return $prefix . $date . $nomor;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiRetur extends Model
{
    public static function generateNomorRetur(){
        $id = self::max('id');
        return "RT" . str_pad($id + 1, 6, "0", STR_PAD_LEFT);
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class, 'nomor_transaksi', 'nomor_transaksi');
    }

    public function items(){
        return $this->hasMany(TransaksiReturItem::class, 'transaksi_retur_id');
    }
}
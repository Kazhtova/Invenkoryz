<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KartuStokResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $tanggal = Carbon::parse($this->created_at)->locale('id')->translatedFormat('l, d F Y');
        return [
          'nomor_transaksi'     => $this->nomor_transaksi,
          'jenis_transaksi'     => $this->jenis_transaksi,
          'tanggal'             => $tanggal,
          'jumlah_masuk'        => $this->jumlah_masuk,
          'jumlah_keluar'       => $this->jumlah_keluar,
          'stok_akhir'          => $this->stok_akhir,
          'petugas'             => $this->petugas  
        ];
    }
}
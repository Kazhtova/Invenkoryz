<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportLaporanKartuStok implements FromCollection, WithHeadings, WithCustomStartCell, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $query, $varian, $tanggalAwal, $tanggalAkhir;

    public function __construct($query, $varian, $tanggalAwal, $tanggalAkhir)
    {
        $this->query = $query;
        $this->varian = $varian;

        $formatedTanggalAwal = Carbon::parse($tanggalAwal)->locale('id')->format('d F Y');
        $this->tanggalAwal = $formatedTanggalAwal;

        $formatedTanggalAkhir = Carbon::parse($tanggalAkhir)->locale('id')->format('d F Y');
        $this->tanggalAkhir = $formatedTanggalAkhir;
    }
    
    public function collection()
    {
        $data = [];
        foreach ($this->query as $index => $item){
            $data[] = [
              'no'                  => $index + 1,
              'produk'              => $this->varian->produk->nama_produk . ' ' . $this->varian->nama_varian,
              'nomor_sku'           => $this->varian->nomor_sku,
              'tanggal_transaksi'   => Carbon::parse($item->created_at)->locale('id')->format('d-m-Y'),
              'jenis_transaksi'     => $item->jenis_transaksi,
              'jumlah_masuk'        => $item->jumlah_masuk,
              'jumlah_keluar'       => $item->jumlah_keluar,
              'stok_akhir'          => $item->stok_akhir,
              'petugas'             => $item->petugas
            ];
        }
        return collect($data);
    }

    public function headings(): array
    {
        return [
          'No',
          'Produk',
          'Nomor Sku',
          'Tanggal Transaksi',
          'Jenis Transaksi',
          'Jumlah Masuk',
          'Jumlah Keluar',
          'Stok Akhir',
          'Petugas'  
        ];
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function registerEvents(): array
    {
        return[
         AfterSheet::class => function(AfterSheet $event){
                $event->sheet->mergeCells('A1:I1');
                $event->sheet->setCellValue('A1', 'LAPORKAN KARTU STOK ' . $this->varian->produk->nama_produk . ' ' . $this->varian->nama_varian);
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

                $event->sheet->mergeCells('A2:I2');
                $event->sheet->setCellValue('A2', 'Periode ' . $this->tanggalAwal . ' s/d ' . $this->tanggalAkhir);
                $event->sheet->getStyle('A2')->getFont()->setSize(14);
                $event->sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            }
        ];
    }
}
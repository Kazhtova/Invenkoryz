@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div class="">
            <h4 class="card-title">{{ $transaksi->nomor_transaksi }}</h4>
        </div>
        <a href="{{ route('transaksi-masuk.index') }}" class="text-primary">Kembali</a>
    </div>
    <div class="card-body">
        <x-meta-item label="Pengirim" value="{{ $transaksi->pengirim }}"/>
        <x-meta-item label="Kontak" value="{{ $transaksi->kontak }}" />
        <x-meta-item label="Jumlah Barang" value="{{ number_format($transaksi->jumlah_barang) }}" />
        <x-meta-item label="Total Harga" value="Rp {{ number_format($transaksi->total_harga) }}" />
        <x-meta-item label="Keterangan" value="{{ $transaksi->keterangan }}" />
        <x-meta-item label="Petugas" value="{{ $transaksi->petugas }}" />
        <x-meta-item label="Tanggal Transaksi" value="{{ $transaksi->formated_date }}" />
        
        <div class="mt-4">
            <h6>Detail Barang</h6>    
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Nomor Batch</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->produk }} {{ $item->nama_varian }}</td>
                            <td>{{ $item->nomor_batch }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp. {{ number_format($item->harga) }}</td>
                            <td>Rp. {{ number_format($item->sub_total) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Grand Total</th>
                        <th>Rp. {{ number_format($transaksi->total_harga) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>                            
    </div>
</div>
@endsection

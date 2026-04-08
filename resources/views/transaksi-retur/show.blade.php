@extends('layout.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="card-title">Nomor Retur: {{ $transaksi->nomor_retur }}</h4>
        <a hre="{{ route('transaksi-retur.index') }}" class="text-primary">Kembali</a>
    </div>
    <div class="card-body">
        <x-meta-item label="Pengirim" value="{{ $transaksi->transaksi->pengirim }}"/>
        <x-meta-item label="Kontak" value="{{ $transaksi->transaksi->kontak }}"/>
        <x-meta-item label="Nomor Transaksi" value="{{ $transaksi->transaksi->nomor_transaksi }}"/>
        <x-meta-item label="Jumlah Harga" value="{{ $transaksi->transaksi->jumlah_harga }}"/>
        <x-meta-item label="Jumlah Barang" value="{{ $transaksi->transaksi->jumlah_barang }}"/>
        <x-meta-item label="Petugas" value="{{ $transaksi->transaksi->petugas }}"/>
        <x-meta-item label="Tanggal Retur" value="{{ $transaksi->transaksi->tanggal_retur }}"/>

            <div class="mt-3">
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
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->produk }} {{ $item->varian }}</td>
                                <td>{{ $item->nomor_batch }}</td>
                                <td>{{ number_format($item->qty) }} pcs</td>
                                <td>Rp. {{ number_format($item->harga) }}</td>
                                <td>Rp. {{ number_format($item->sub_total) }}</td>
                                <td>{{ $item->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6">Grand Total</th>
                            <th>Rp. {{ number_format($item->jumlah_harga) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
    </div>
</div>
@endsection
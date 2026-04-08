@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card py-5">
    <div class="card-body">
        <div class="row">
            <div class="col-1">
                <x-per-page-option />
            </div>
            <div class="col-10">
                <x-filter-by-field term="search" placeholder="Cari Produk"/>
            </div>
            <div class="col-1">
                <x-button-reset-filter route="transaksi-retur.index"/>
            </div>
        </div>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Retur</th>
                    <th>Nomor Transaksi</th>
                    <th>Pengirim</th>
                    <th>Jumlah Barang</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($retur as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('transaksi.retur.show',  $item->nomor_retur) }}" class="text-primary">{{ $item->nomor_retur }}</a>
                        </td>
                        <td>{{ $item->nomor_transaksi }}</td>
                        <td>{{ $item->transaksi->pengirim }}</td>
                        <td>{{ number_format($item->jumlah_barang) }} pcs</td>
                        <td>Rp. {{ number_format($item->jumlah_harga) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak Ada Data Retur</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $retur->links() }}
    </div>
</div>
@endsection
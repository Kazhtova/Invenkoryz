@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
    <div class="card">
        <div class="card-body py-5">
            <div class="row align-items-center">
                <div class="row col-9 justify-content-between">
                    <div class="col-1">
                        <x-per-page-option />
                    </div>
                    <div class="col-8">
                        <x-filter-by-field term="search" placeholder="Cari Produk...."/>
                    </div>
                    <div class="col-2">
                        <x-filter-by-options term="kategori" :options="$kategori" field="nama_kategori" defaultValue="Pilih Kategori"/>
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-1">
                    <x-button-reset-filter route="master-data.stok-barang.index"/>
                </div>
            </div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px;">No</th>
                        <th>SKU</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Kartu Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['nomor_sku'] }}</td>
                            <td>{{ $item['produk'] }}</td>
                            <td>{{ $item['kategori'] }}</td>
                            <td>{{ number_format($item['stok']) }}</td>
                            <td>Rp. {{ number_format($item['harga']) }}</td>
                            <td>
                                <x-kartu-stok nomor_sku="{{ $item['nomor_sku'] }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Data Produk Kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
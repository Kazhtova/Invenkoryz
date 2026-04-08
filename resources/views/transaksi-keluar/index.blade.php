@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card py-5">
    <div class="card-body">
        <div class="row align-items-end">
            <div class="col-11">
            <form class="row col-12 align-items-center" action="{{ route('transaksi-keluar.index') }}" method="GET">
                <div class="col-4">
                    <label for="penerima" class="form-label">Penerima</label>
                    <input type="text" name="penerima" id="penerima" class="form-control" placeholder="Nama penerima" value="{{ request('penerima') }}">
                </div>
                <div class="col-3">
                    <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                </div>
                <div class="col-3">
                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-2 d-flex gap-1">
                    <div>
                        <label for="filter" class="forml-label">&nbsp;</label>
                        <button type="submit" class="btn btn-icon btn-round border w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                
                    <div>
                        <label for="filter" class="form-label">&nbsp;</label>
                        <button type="reset" onclick="window.location.href='{{ route('transaksi-keluar.index') }}'" id="btn-reset" class="btn btn-outline-danger btn-round w-100">
                            Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-1">
            <x-form-export-laporan jenisTransaksi="pengeluaran" />
        </div>
        </div>
        <div>
        <table class="table mt-5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Transaksi</th>
                <th>Jumlah Barang</th>
                <th>Total Harga</th>
                <th>penerima</th>
                <th>Tanggal Transaksi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nomor_transaksi }}</td>
                    <td>{{ number_format($item->jumlah_barang) }} pcs</td>
                    <td>Rp. {{ number_format($item->total_harga) }}</td>
                    <td>{{ $item->penerima }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y') }}</td>
                    <td>
                        <a href="{{ route('transaksi-keluar.show', $item->nomor_transaksi) }}" class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak Ada Transaksi</td>
                </tr>
            @endforelse
        </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
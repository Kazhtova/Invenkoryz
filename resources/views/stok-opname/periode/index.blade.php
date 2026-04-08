@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card py-5">
    <div class="d-flex justify-content-end">
        <x-stok-opname.form-periode-stok-opname />
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Periode</th>
                <th>Jumlah Barang</th>
                <th>Jumlah Barang Sesuai</th>
                <th>Jumlah Barang Selisih</th>
                <th>Status Kerja</th>
                <th>Pelaporan Stok Opname</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dataPeriode as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['periode'] }}</td>
                    <td>{{ $item['jumlah_barang'] }}</td>
                    <td>{{ $item['jumlah_barang_sesuai'] }}</td>
                    <td>{{ $item['jumlah_barang_selisih'] }}</td>
                    <td>{{ $item['is_active'] ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <span class="badge text-white {{ $item['is_completed'] ? 'bg-success' : 'bg-danger' }} px-2 py-1">
                            {{ $item['is_completed'] ? 'Lengkap' : 'Belum Lengkap' }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-1">
                            <a href="{{ route('stok-opname.periode.show', $item['id']) }}" class="btn btn-info btn-icon btn-round">
                                <i class="fas fa-book"></i>
                            </a>
                            <x-stok-opname.form-periode-stok-opname id="{{ $item['id'] }}"/>
                            <x-confirm-delete id="{{ $item['id'] }}" route="stok-opname.periode.destroy"/>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum Ada Data Periode Stok Opname</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card py-5">
    <div class="card-body">
        <div class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SKU</th>
                    <th>Produk</th>
                    <th>Stok</th>
                    <th>Jumlah Terlapor</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Petugas</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->varian->nomor_sku }}</td>
                        <td>{{ $item->produk }}</td>
                        <td>{{ $item->varian->stok_varian }}</td>
                        <td>{{ $item->jumlah_dilaporkan }}</td>
                        <td>
                            <span class="badge
                            
                            {{ 
                                $item->status == 'selisih' ? 'bg-danger' :
                                ($item->status == 'sesuai' ? 'bg-success' : 'bg-secondary')
                            }}

                            text-capitalize">
                                {{ $item->status }}
                        </span>
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->petugas }}</td>
                        <td>
                            <div>
                                <x-stok-opname.form-input-item :item="$item" />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </div>
    </div>
</div>
@endsection
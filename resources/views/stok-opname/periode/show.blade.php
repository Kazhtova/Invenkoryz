@extends('layouts.kai')
@section('page_title',$pageTitle)
@section('content')
<div class="card p-5">
    <div>
        <x-meta-item label="Periode" value="{{ $dataPeriode->periode }}" />
        <x-meta-item label="Jumlah Barang" value="{{ $dataPeriode->jumlah_barang }}" />
        <x-meta-item label="Jumlah Barang Sesuai" value="{{ $dataPeriode->jumlah_barang_sesuai }}" />
        <x-meta-item label="Jumlah Barang Selisih" value="{{ $dataPeriode->jumlah_barang_selisih }}" />
        <x-meta-item label="Status Kerja" value="{{ $dataPeriode->is_active ? 'Aktif' : 'Tidak Aktif' }}" />
        <x-meta-item label="Pelaporan Stok Opname" value="{{ $dataPeriode->is_completed ? 'Lengkap' : 'Belum Lengkap' }}" />
    </div>
    <div class="mt-5">
        <div>
            <button class="btn btn-primary btn-sm" id="btn-update-produk">Update Daftar Produk</button>
        </div>
        <table class="table">
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
                </tr>
            </thead>
            <tbody>
                @foreach($dataPeriode as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nomor_sku }}</td>
                        <td>{{ $item->produk }}</td>
                        <td>{{ $item->jumlah_stok }}</td>
                        <td>{{ $item->jumlah_dilaporkan }}</td>
                        <td>
                            <div>
                                <span class="badge text-capitalize
                                    {{ 
                                        $item->status == 'selisih' ? 'bg-danger' :
                                        ($item->status == 'sesuai' ? 'bg-success' : 'bg-secondary')
                                    }}
                                ">
                                {{ $item->status }}
                                </span>
                            </div>
                        </td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->petugas }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
           $("#btn-update-produk").on("click", function () {
             $.ajax({
                type: "POST",
                url: "{{ route('stok-opname.update-produk') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    periode_id: "{{ $dataPeriode->id }}"
                },
                success: function (response) {
                    isSuccess = response.success
                    swal({
                        icon: isSuccess ? 'success' : 'warning',
                        title: isSuccess ? 'Berhasil' : 'Gagal',
                        text: response.message,
                        timer:3000
                    }).then(() => {
                        window.location.href = response.redirect_url
                    })
                }
            });
           });
        });
    </script>
@endpush
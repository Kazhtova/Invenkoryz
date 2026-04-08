@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
<div class="card">
    <div class="card-body py-5">
        <div class="row">
            <div class="row col-10 align-items-center justify-content-between">
                <div class="col-1">
                    <x-per-page-option />
                </div>
                <div class="col-9">
                    <x-filter-by-field term="search" placeholder="Cari Kategori Produk"/>
                </div>
                <div class="col-1">
                    <x-button-reset-filter route="master-data.kategori-produk.index"/>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-ent">
                <x-kategori-produk.form-kategori-produk />
            </div>
        </div>
        
        <table class="table mt-5">
            <thead>
                <tr>
                    <th class="text-center" style="width: 15px;">No</th>
                    <th>Nama Kategori</th>
                    <th class="text-center" style="width: 100px;">Opsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <x-kategori-produk.form-kategori-produk id="{{ $item->id }}"/>
                                <x-confirm-delete id="{{ $item->id }}" route="master-data.kategori-produk.destroy" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Data Kategory Kosong</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $kategori->links() }}
    </div>
</div>
@endsection
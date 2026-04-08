@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Detail : {{ $produk->nama_produk }}</h4>
            <a href="{{ route('master-data.produk.index') }}" class="text-primary">Kembali</a>
        </div>
        <div class="card-body py-5">
            <x-meta-item label="Nama Produk" value="{{ $produk->nama_produk }}"/>
            <x-meta-item label="Kategori" value="{{ $produk->kategori->nama_kategori }}"/>
            <x-meta-item label="Deskripsi" value="{{ $produk->deskripsi_produk }}"/>
                <div class="mt-2">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-dark btn-sm btn-round" data-bs-toggle="modal" data-bs-target="#modalFormVarian" id="btnTambahVarian">
                            Tambah Varian
                        </button>
                    </div>
                    <div class="row mt-2">
                        @forelse ($produk->varian as $item)
                        <div class="col-4">
                            <x-produk.card-varian :varian="$item"/>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="alert alert-info" style="box-shadow: none">
                                <span>Belum Ada Variant, Silahkan Tambahkan Variant Baru</span>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
        </div>
    </div>
    <x-produk.form-varian />
@endsection
@push('script')
<script>
    $(document).ready(function() {
        let modalEl = $('#modalFormVarian')
        let modal = new bootstrap.Modal(modalEl)
        let $form = $('#modalFormVarian Form')

        $("#btnTambahVarian").on('click', function (){
            $form[0].reset()
            $form.attr('action')
            $form.find('small.text-danger').text('')
            $('#modalFormVarian .modal-title').text('Tambah Varian Baru')
            modal.show()
        })

        $('.btnEditVarian').on('click', function () {
            let nama_varian = $(this).data('nama-varian')
            let harga_varian = $(this).data('harga-varian')
            let stok_varian= $(this).data('stok-varian')
            let action = $(this).data('action')

            $form[0].reset()
            $form.attr('action', action)

            $form.append('<input type="hidden" name="_method" value="PATCH">')

            $form.find('input[name="nama_varian"]').val(nama_varian)
            $form.find('input[name="harga_varian"]').val(harga_varian)
            $form.find('input[name="stok_varian"]').val(stok_varian)
            $form.find('small.text-danger').text('');
            $('#modalFormVarian .modal-title').text('Edit Varian')

            modal.show()
        })

        $form.submit(function (e) {
            e.preventDefault()
            let formData = new FormData(this)

            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    swal({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        timer: 2000,
                    }).then(() => {
                        modal.hide()
                        location.reload()  
                    })
                },
                error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors)

                $form.find('small.text-danger').text('')
                $.each(errors, function(key, val) {
                    $form.find('[name="' + key + '"]').next('small.text-danger').text(val[0])
                })
            }
            });
            
        })


        $('#formDeleteVarian').on('click', function (e) {
            e.preventDefault()
            const form = this
            swal({
                title: 'Apakah Anda Yakin',
                text: 'Anda Tidak Dapat Mengembalikan Data Ini.',
                icon: 'warning',
                button: true,
                dangerMode: true
            }).then((isConfirm) => {
                if(isConfirm) {
                    form.submit()
                }
            })
        });

    })
</script>
@endpush
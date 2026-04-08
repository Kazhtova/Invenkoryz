<div>
    <!-- Modal -->
    <div class="modal fade" id="modalFormVarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFormVarianLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="produk_id" id="produk_id" value="{{ $produk_id ?? '' }}">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalFormVarianLabel">Form Varian</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_varian" class="form-label">Nama Varian</label>
                        <input type="text" name="nama_varian" id="nama_varian" class="form-control" value="{{ old('nama_varian', $nama_varian ?? '') }}">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="harga_varian" class="form-label">Harga</label>
                        <input type="number" name="harga_varian" id="harga_varian" class="form-control" value="{{ old('harga_varian', $harga_varian ?? '') }}">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="stok_varian" class="form-label">Stok</label>
                        <input type="number" name="stok_varian" id="stok_varian" class="form-control" value="{{ old('stok_varian', $stok_varian ?? '') }}">
                        <small class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="gambar_varian" class="form-label">Gambar</label>
                        <input type="file" name="gambar_varian" id="gambar_varian" class="form-control">
                        <small class="text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
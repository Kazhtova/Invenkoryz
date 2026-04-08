<div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-round {{ $id ? 'btn-primary btn-icon' : 'btn-dark' }}" data-bs-toggle="modal" data-bs-target="#formKategori{{ $id ?? '' }}">
  @if ($id)
    <i class="fas fa-edit"></i>
  @else
    <span>Kategori Baru</span>
  @endif
</button>

<!-- Modal -->
<div class="modal fade" id="formKategori{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formKategoriLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form action="{{ $action }}" method="POST">
          @csrf
          @if ($id)
          @method('PATCH')
          @endif
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="formKategoriLabel">Form Kategori Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nama_kategori" class="form-label">Nama Kategori</label>
          <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori', $nama_kategori ?? '') }}">
          @error('nama_kategori')
          <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
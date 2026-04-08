<div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-round {{ $id ? 'btn-primary btn-icon':'btn-dark' }}" data-bs-toggle="modal" data-bs-target="#formPeriode {{ $id ?? '' }}">
  @if($id){
    <i class="fas fa-edit"></i>
  }
  @else
  <span>Buat Periode</span> 
  @endif
</button>

<!-- Modal -->
<div class="modal fade" id="formPeriode {{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formPeriodeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" action="{{ $action }}" method="POST">
        @csrf
        @if($id)
        @method('PATCH')
        @endif
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="formPeriodeLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div><h1></h1>
      <div class="modal-body">
        <div class="form-group">
          <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
          <input type="text" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $tanggal_mulai ?? '') }}">
          @error('tanggal_mulai')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group">
          <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
          <input type="text" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $tanggal_selesai ?? '') }}">
          @error('tanggal_selesai')
            <small class="text-danger">{{ $message }}</small>
          @enderror
        </div>
        <div class="form-group d-flex flex-column">
          <label for="is_active" class="form-label">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $is_active ?? 0) == 1 ? 'checked' : '' }}> Aktifkan Langsung
          </label>
          <small>
            {{ $id ? 'Jika tidak diaktifkan makan tidak dapat melakukan pencatatan stok opname' : 'Pastikan Periode Sebelumnya Sudah Selesai Sebelum Mengaktifkan Periode Ini'}}
          </small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
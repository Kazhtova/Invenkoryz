<div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-round btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Export
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('export-laporan-transaksi') }}" method="POST">
        @csrf
        <input type="hidden" name="jenis_transaksi" value="{{ $jenisTransaksi }}">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Export Laporan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if($jenisTransaksi == 'pemasukan')
        <div class="form-group">
        <label for="pengirim" class="form-label">Pengirim</label>
        <input type="text" name="pengirim" id="pengirim" class="form-control" placeholder="Nama Pengirim">
       </div>
        @else
       <div class="form-group">
        <label for="penerima" class="form-label">Penerima</label>
        <input type="text" name="penerima" id="penerima" class="form-control" placeholder="Nama Penerima">
       </div>
        @endif
        <div class="form-group mt-1">
            <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control">
            @error('tanggal_awal')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-1">
            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
            @error('tanggal_akhir')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group mt-1 d-flex align-items-center gap-1">
            <label for="is_completed" class="form-label">
                Download Dengan Items
                <input type="checkbox" name="is_completed" id="is_completed">
            </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Export Laporan</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
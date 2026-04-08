<form class="d-flex align-items-center" action="/export-laporan-kartu-stok" method="POST">
    @csrf
    <input type="hidden" name="nomor_sku" value="{{ $nomorSku }}">
    <div class="form-group">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" id="tanggal_awak" class="form-control">
        @error('tanggal_awal')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control">
        @error('tanggal_akhir')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
        <select name="jenis_transaksi" id="jenis_transaksi" class="form-control">
            <option value="">Pilih Jenis Transaksi</option>
            @foreach($jenisTransaksi as $item)
            <option value={{ $item }}>{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group pt-3">
        <label for="">&nbsp;</label>
        <button type="submit" class="btn btn-primary">Export</button>
    </div>
</form>
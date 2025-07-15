<div class="modal fade" id="modalEdit{{ $app->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $app->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Edit Data</h4>

            <form method="POST" action="{{ route('applications.update', $app->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi" value="{{ $app->nama_aplikasi }}" class="form-control border-primary" placeholder="Masukkan Nama Aplikasi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Harga</label>
                        <input type="text" name="harga" value="{{ $app->harga }}" class="form-control border-primary" placeholder="Masukkan Harga">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Versi</label>
                        <input type="text" name="versi" value="{{ $app->versi }}" class="form-control border-primary" placeholder="Masukkan Versi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Lokasi Pembelian</label>
                        <select name="lokasi_pembelian" class="form-select border-primary">
                            <option value="">Pilih Lokasi Pembelian</option>
                            <option value="Official" {{ $app->lokasi_pembelian == 'Official' ? 'selected' : '' }}>Official</option>
                            <option value="E-Commerce" {{ $app->lokasi_pembelian == 'E-Commerce' ? 'selected' : '' }}>E-Commerce</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Kategori</label>
                        <input type="text" name="kategori" value="{{ $app->kategori }}" class="form-control border-primary" placeholder="Masukkan Kategori">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" value="{{ $app->tanggal_pembelian }}" class="form-control border-primary">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Status</label>
                        <select name="status" class="form-select border-primary">
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ $app->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non-Aktif" {{ $app->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Bukti Pembelian</label>
                        <input type="file" name="bukti_pembelian" class="form-control border-primary">
                        @if ($app->bukti_pembelian)
                            <small class="d-block mt-1">
                                File saat ini: <a href="{{ asset('storage/' . $app->bukti_pembelian) }}" target="_blank">Lihat</a>
                            </small>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold text-primary">Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ $app->deskripsi }}" class="form-control border-primary" placeholder="Masukkan Deskripsi">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

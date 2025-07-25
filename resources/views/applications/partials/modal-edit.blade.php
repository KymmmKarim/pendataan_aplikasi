<div class="modal fade" id="modalEdit{{ $app->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $app->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Edit Data</h4>

            <form method="POST" action="{{ route('applications.update', $app->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi" value="{{ $app->nama_aplikasi }}" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="text" name="harga" value="{{ $app->harga }}" class="form-control border-dark" placeholder="Masukkan Harga" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Versi</label>
                        <input type="text" name="versi" value="{{ $app->versi }}" class="form-control border-dark" placeholder="Masukkan Versi">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Pembelian</label>
                        <select name="lokasi_pembelian" class="form-select border-dark" required>
                            <option value="">Pilih Lokasi Pembelian</option>
                            <option value="Official" {{ $app->lokasi_pembelian == 'Official' ? 'selected' : '' }}>Official</option>
                            <option value="E-Commerce" {{ $app->lokasi_pembelian == 'E-Commerce' ? 'selected' : '' }}>E-Commerce</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Masa Berlaku</label>
                        <input type="date" name="masa_berlaku" value="{{ $app->masa_berlaku }}" class="form-control border-dark">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" value="{{ $app->tanggal_pembelian }}" class="form-control border-dark" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select border-dark" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ $app->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non-Aktif" {{ $app->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Bukti Pembelian</label>
                        <input type="file" name="bukti_pembelian" class="form-control border-dark">
                        @if ($app->bukti_pembelian)
                            <small class="d-block mt-1">
                                File saat ini: <a href="{{ asset('storage/' . $app->bukti_pembelian) }}" target="_blank">Lihat</a>
                            </small>
                        @endif
                    </div>

                    <div class="mb-3">
    <label for="unit_id" class="form-label">Unit</label>
    <select name="unit_id" id="unit_id" class="form-select" required>
        <option value="">-- Pilih Unit --</option>
        @foreach($units as $unit)
            <option value="{{ $unit->id }}" {{ old('unit_id', $application->unit_id ?? '') == $unit->id ? 'selected' : '' }}>
                {{ $unit->nama }}
            </option>
        @endforeach
    </select>
</div>


                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ $app->deskripsi }}" class="form-control border-dark" placeholder="Masukkan Deskripsi" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

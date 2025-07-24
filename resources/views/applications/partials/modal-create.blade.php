<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Tambah Data</h4>

            <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nama_aplikasi" class="form-label fw-semibold">Nama Aplikasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_aplikasi" id="nama_aplikasi" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                        <input type="text" name="harga" id="harga" class="form-control border-dark" placeholder="Masukkan Harga" required>
                    </div>
                    <div class="col-md-6">
                        <label for="versi" class="form-label fw-semibold">Versi<span class="text-danger">*</span></label>
                        <input type="text" name="versi" id="versi" class="form-control border-dark" placeholder="Masukkan Versi">
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi_pembelian" class="form-label fw-semibold">Lokasi Pembelian <span class="text-danger">*</span></label>
                        <select name="lokasi_pembelian" id="lokasi_pembelian" class="form-select border-dark" required>
                            <option value="">Pilih Lokasi Pembelian</option>
                            <option value="Official">Official</option>
                            <option value="E-Commerce">E-Commerce</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="masa_berlaku" class="form-label fw-semibold">Masa Berlaku<span class="text-danger">*</span></label>
                        <input type="date" name="masa_berlaku" id="masa_berlaku" class="form-control border-dark">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_pembelian" class="form-label fw-semibold">Tanggal Pembelian<span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control border-dark">
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select border-dark" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="bukti_pembelian" class="form-label fw-semibold">Bukti Pembelian <span class="text-danger">*</span></label>
                        <input type="file" name="bukti_pembelian" id="bukti_pembelian" class="form-control border-dark" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control border-dark" placeholder="Masukkan Deskripsi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="unit_id" class="form-label fw-semibold">Pilih Unit <span class="text-danger">*</span></label>
                        <select name="unit_id" id="unit_id" class="form-select border-dark" required>
                            <option value="">-- Pilih Unit --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

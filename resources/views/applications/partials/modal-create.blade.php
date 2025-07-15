<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Tambah Data</h4>

            <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi" class="form-control border-primary" placeholder="Masukkan Nama Aplikasi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Harga</label>
                        <input type="text" name="harga" class="form-control border-primary" placeholder="Masukkan Harga">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Versi</label>
                        <input type="text" name="versi" class="form-control border-primary" placeholder="Masukkan Versi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Lokasi Pembelian</label>
                        <select name="lokasi_pembelian" class="form-select border-primary">
                            <option value="">Pilih Lokasi Pembelian</option>
                            <option value="Official">Official</option>
                            <option value="E-Commerce">E-Commerce</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Kategori</label>
                        <input type="text" name="kategori" class="form-control border-primary" placeholder="Masukkan Kategori">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" class="form-control border-primary">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Status</label>
                        <select name="status" class="form-select border-primary">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-primary">Bukti Pembelian</label>
                        <input type="file" name="bukti_pembelian" class="form-control border-primary">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold text-primary">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control border-primary" placeholder="Masukkan Deskripsi">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

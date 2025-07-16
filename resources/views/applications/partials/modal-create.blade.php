<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">

            <h4 class="mb-4 fw-bold text-primary">Tambah Data</h4>

            <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="text" name="harga" class="form-control border-dark" placeholder="Masukkan Harga">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Versi</label>
                        <input type="text" name="versi" class="form-control border-dark" placeholder="Masukkan Versi">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Pembelian</label>
                        <select name="lokasi_pembelian" class="form-select border-dark">
                            <option value="">Pilih Lokasi Pembelian</option>
                            <option value="Official">Official</option>
                            <option value="E-Commerce">E-Commerce</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Masa Berlaku</label>
                        <input type="date" name="masa_berlaku" class="form-control border-dark">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" class="form-control border-dark">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select border-dark">
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Bukti Pembelian</label>
                        <input type="file" name="bukti_pembelian" class="form-control border-dark">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control border-dark" placeholder="Masukkan Deskripsi">
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

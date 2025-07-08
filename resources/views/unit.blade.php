<x-app-layout>
    <x-slot name="header">
        UPT-TIK
    </x-slot>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
                Tambah Data
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">
                        <thead class="table-light border-bottom">
                            <tr>
                                <th>Nama Aplikasi</th>
                                <th>Versi</th>
                                <th>Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 7; $i++)
                                <tr>
                                    <td><strong>Info Dasar</strong></td>
                                    <td>1.0</td>
                                    <td>Unit</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editData" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="{{ url('unit/1/detail') }}" class="btn btn-sm btn-outline-dark me-1" title="Detail">
                                            <i class="bi bi-people"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4">
                <h4 class="mb-4 fw-bold">Tambah Data</h4>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" name="nama_aplikasi" class="form-control" placeholder="Masukkan Nama Aplikasi">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Versi</label>
                            <input type="text" name="versi" class="form-control" placeholder="Masukkan Versi">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi Pembelian</label>
                            <select name="status" class="form-select">
                                <option value="">Pilih Lokasi Pembelian</option>
                                <option value="Official">Official</option>
                                <option value="E-Commerce">E-Commerce</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Masukkan Jenis Kategori">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control">
                        </div>
                         <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bukti Pembelian</label>
                            <input type="file" name="bukti_pembelian" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4">
                <h4 class="mb-4 fw-bold">Edit Data</h4>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" name="nama_aplikasi" class="form-control" placeholder="Masukkan Nama Aplikasi">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Versi</label>
                            <input type="text" name="versi" class="form-control" placeholder="Masukkan Versi">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi Pembelian</label>
                            <select name="status" class="form-select">
                                <option value="">Pilih Lokasi Pembelian</option>
                                <option value="Official">Official</option>
                                <option value="E-Commerce">E-Commerce</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Masukkan Jenis Kategori">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control">
                        </div>
                         <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Bukti Pembelian</label>
                            <input type="file" name="bukti_pembelian" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>

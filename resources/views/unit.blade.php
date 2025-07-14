<x-app-layout>
    <x-slot name="header">
        Application List
    </x-slot>

    <div class="container mt-4">
        <!-- Header + Search + Tambah -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>
            <div class="d-flex flex-wrap gap-2">
                <form method="GET" action="{{ url()->current() }}" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari aplikasi..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
    Tambah Data
</a>

            </div>
        </div>

        <!-- Tabel -->
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

    <!-- Modal Tambah -->
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
                            <select name="lokasi_pembelian" class="form-select">
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

    <!-- Modal Edit -->
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
                            <select name="lokasi_pembelian" class="form-select">
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

</x-app-layout>

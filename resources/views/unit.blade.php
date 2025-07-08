<x-app-layout>
    <x-slot name="header">
        UPT-TIK
    </x-slot>

    <div class="container mt-4">
        <!-- Judul dan tombol tambah -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
                Tambah Data
            </a>
        </div>

        <!-- Card berisi tabel -->
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
                                        <a href="#" class="btn btn-sm btn-outline-primary me-1"data-bs-toggle="modal" data-bs-target="#editData" title="Edit">
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4">
                <h4 class="mb-4 fw-bold">Tambah Data</h4>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" name="nama_aplikasi" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Versi</label>
                            <input type="text" name="versi" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi Pembelian</label>
                            <input type="text" name="lokasi_pembelian" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bukti Pembelian</label>
                            <input type="file" name="bukti_pembelian" class="form-control">
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

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4">
                <h4 class="mb-4 fw-bold">Edit Data</h4>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Aplikasi</label>
                            <input type="text" name="nama_aplikasi" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Versi</label>
                            <input type="text" name="versi" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi Pembelian</label>
                            <input type="text" name="lokasi_pembelian" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" placeholder="Tambahkan Text">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bukti Pembelian</label>
                            <input type="file" name="bukti_pembelian" class="form-control">
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

    <!-- Custom CSS langsung di halaman -->
    <style>
        .custom-table td, .custom-table th {
            border-top: none !important;
            border-bottom: 1px solid #dee2e6;
        }
        .custom-table thead th {
            border-bottom: 2px solid #dee2e6;
        }
    </style>

    <!-- Pastikan Bootstrap JS aktif -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-app-layout>
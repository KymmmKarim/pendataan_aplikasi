<x-app-layout>
   <x-slot name="header">
        UPT-TIK
    </x-slot>

    <div class="container mt-4">

        <!-- Judul dan tombol tambah -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>
            <a href="#" class="btn btn-primary">Tambah Data</a>
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
                                    <td>Pria</td>
                                    <td>Unit</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-dark me-1" title="Detail">
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
</x-app-layout>

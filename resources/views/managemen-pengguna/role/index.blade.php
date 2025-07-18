<x-app-layout>
    <x-slot name="header">
        Hak Akses
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark fw-semibold">
                    <i class="fas fa-user-shield me-2"></i>Daftar Role
                </h5>
                <a href="role/create" class="btn btn-sm btn-primary">
                    <i></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle w-100" id="rolesTable">
                        <thead class="table-light text-center text-dark">
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>GUARD</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th style="width: 130px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 20; $i++) <!-- contoh isi banyak -->
                            <tr>
                                <td class="text-center">{{ $i }}</td>
                                <td><span class="fw-semibold">Role {{ $i }}</span></td>
                                <td><span class="text-dark">web</span></td>
                                <td><span class="text-muted small">2025-07-{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</span></td>
                                <td><span class="text-muted small">2025-07-18</span></td>
                                <td class="text-center">
                                    <a href="role/edit" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables CSS & JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#rolesTable').DataTable({
                scrollY: '300px', // << scroll hanya di isi tabel
                scrollCollapse: true,
                paging: false,    // nonaktifkan pagination (optional)
                info: false,      // nonaktifkan info bawah
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari role...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });
        });
    </script>
</x-app-layout>
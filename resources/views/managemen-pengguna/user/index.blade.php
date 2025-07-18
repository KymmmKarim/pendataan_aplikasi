<x-app-layout>
    <x-slot name="header">
        Manajemen Pengguna
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark fw-semibold">
                    <i class="fas fa-users me-2"></i>Daftar Pengguna
                </h5>
                <a href="role/create" class="btn btn-sm btn-primary">
                    <i></i> Tambah Data
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="usersTable">
                        <thead class="table-light text-center text-dark">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Unit</th>
                                <th style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 20; $i++)
                                <tr>
                                    <td class="text-center">{{ $i }}</td>
                                    <td>Admin Itenas {{ $i }}</td>
                                    <td>admin{{ $i }}@example.com</td>
                                    <td>adminitenas{{ $i }}</td>
                                    <td class="text-center">
                                        <span>Admin</span>
                                    </td>
                                    <td class="text-center">
                                        Teknik Informatika
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
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
            $('#usersTable').DataTable({
                scrollY: '300px',
                scrollCollapse: true,
                paging: false,
                info: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari pengguna...",
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

<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Manajemen Pengguna</h5>
            <a href="{{ url('users/create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-user-plus me-1"></i> Tambah Pengguna
            </a>
        </div>
    </x-slot>

    <div class="container-fluid mt-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Search -->
                <form method="GET" class="row mb-4">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau role...">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-primary w-100">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh dummy data --}}
                            @for ($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>Admin Itenas {{ $i }}</td>
                                <td>admin{{ $i }}@example.com</td>
                                <td>adminitenas{{ $i }}</td>
                                <td><span class="badge bg-primary">Admin</span></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (dummy) -->
                <nav class="mt-3">
                    <ul class="pagination pagination-sm justify-content-end">
                        <li class="page-item disabled"><a class="page-link">«</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</x-app-layout>

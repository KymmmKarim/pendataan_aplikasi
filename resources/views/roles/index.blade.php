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
                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">
                    <i></i> Tambah Data
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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
                            @forelse ($roles as $index => $role)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><span class="fw-semibold">{{ $role->name }}</span></td>
                                    <td><span class="text-dark">{{ $role->guard_name }}</span></td>
                                    <td><span class="text-muted small">{{ $role->created_at->format('Y-m-d') }}</span></td>
                                    <td><span class="text-muted small">{{ $role->updated_at->format('Y-m-d') }}</span></td>
                                    <td class="text-center">
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-id="{{ $role->id }}" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">Belum ada data role.</td></tr>
                            @endforelse
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

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('#rolesTable').DataTable({
                paging: true,
                pageLength: 10,
                ordering: false,
                info: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari role...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });

            // SweetAlert konfirmasi hapus
            $('.btn-hapus').click(function () {
                let roleId = $(this).data('id');
                Swal.fire({
                    title: 'Yakin mau dihapus ?',
                    text: "Data yang dihapus tidak dapat dikembalikan loh!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + roleId).submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>

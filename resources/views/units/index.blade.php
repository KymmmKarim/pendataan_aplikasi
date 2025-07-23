<x-app-layout>
    <x-slot name="header">
        Manajemen Unit
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark fw-semibold">
                    <i class="fas fa-building me-2"></i>Daftar Unit
                </h5>
                <a href="{{ route('units.create') }}" class="btn btn-sm btn-primary">
                    Tambah Unit
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" id="unitsTable">
                        <thead class="table-light text-center text-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Singkatan</th>
                                <th>Urut</th>
                                <th>Parent_id</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $index => $unit)
                                <tr>
                                    <td class="text-center">{{ $unit->no }}</td>
                                    <td>{{ $unit->nama }}</td>
                                    <td>{{ $unit->singkatan }}</td>
                                    <td class="text-center">{{ $unit->urut }}</td>
                                    <td>{{ $unit->parent->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $unit->aktif ? 'success' : 'secondary' }}">
                                            {{ $unit->aktif ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
    <div class="d-flex justify-content-center gap-1">
        <!-- Tombol Edit -->
        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-edit"></i>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus unit ini?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" type="submit">
                <i class="fas fa-trash-alt"></i>
            </button>
        </form>
    </div>
</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#unitsTable').DataTable({
                ordering: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari unit...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });

            $('.btn-delete-unit').click(function () {
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Yakin mau dihapus?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>

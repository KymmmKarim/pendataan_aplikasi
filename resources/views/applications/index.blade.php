    <x-app-layout>
        <x-slot name="header">
            Application List
        </x-slot>

        <style>
/* Untuk layar <= 768px (tablet & HP) */
@media (max-width: 768px) {
    table th:nth-child(3),
    table td:nth-child(3),
    table th:nth-child(4),
    table td:nth-child(4),
    table th:nth-child(6),
    table td:nth-child(6) {
        display: none; /* Hilangkan kolom versi, masa berlaku, dan aksi */
    }
}

</style>

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Data Aplikasi</h4>

                <div class="d-flex gap-2 align-items-center">
    <div class="input-group input-group-sm" style="max-width: 250px;">
        <input type="text" id="search-input" placeholder="Cari aplikasi..." class="form-control">
        <button class="btn btn-outline-secondary" type="button">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <a href="#" class="btn btn-primary btn-sm py-1 px-3" style="height: 32px;" data-bs-toggle="modal" data-bs-target="#tambahData">
        Tambah
    </a>
</div>

            </div>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-light text-center text-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Aplikasi</th>
                                    <th>Versi</th>
                                    <th>Masa Berlaku</th>
                                    <th>Unit</th>
                                    <th style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="applications-table-body">
    @forelse ($applications as $app)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
    <div class="d-flex align-items-center justify-content-between">
        <strong>{{ $app->nama_aplikasi }}</strong>
        
        <!-- Dropdown hanya di mobile -->
        <div class="dropdown d-md-none ms-1">
            <a href="#" class="text-primary p-0 border-0 bg-transparent" data-bs-toggle="dropdown">
                <i class="bi bi-caret-down-fill"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="{{ route('applications.show', $app->id) }}">
                        <i class="bi bi-info-circle me-1"></i> Detail
                    </a>
                </li>
                <li>
                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $app->id }}">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </button>
                </li>
                <li>
                    <form id="delete-app-{{ $app->id }}" action="{{ route('applications.destroy', $app->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="dropdown-item text-danger btn-delete-app" data-id="{{ $app->id }}">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</td>




            <td>{{ $app->versi }}</td>
            <td>
                {{ $app->masa_berlaku ? \Carbon\Carbon::parse($app->masa_berlaku)->translatedFormat('d F Y') : '-' }}
            </td>
            <td class="text-center">{{ $app->unit->nama ?? '-' }}</td>

            <!-- Kolom aksi hanya muncul di desktop -->
            <td class="text-center d-none d-md-table-cell">
                <div class="d-inline-flex gap-1">
                    <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-outline-dark" title="Lihat Detail">
                        <i class="bi bi-info-circle"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-outline-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit{{ $app->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form id="delete-app-{{ $app->id }}" action="{{ route('applications.destroy', $app->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-app" data-id="{{ $app->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>

        {{-- Modal Edit --}}
        @include('applications.partials.modal-edit', ['app' => $app])
    @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data aplikasi.</td>
        </tr>
    @endforelse
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Tambah --}}
        @include('applications.partials.modal-create')

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('search-input');
                const tableRows = document.querySelectorAll('#applications-table-body tr');

                searchInput.addEventListener('input', function () {
                    const keyword = this.value.toLowerCase();
                    tableRows.forEach(row => {
                        const rowText = row.innerText.toLowerCase();
                        row.style.display = rowText.includes(keyword) ? '' : 'none';
                    });
                    if (keyword === '') {
                        tableRows.forEach(row => row.style.display = '');
                    }
                });

                // Event delegation untuk tombol hapus
                document.body.addEventListener('click', function (event) {
                    if (event.target.closest('.btn-delete-app')) {
                        const button = event.target.closest('.btn-delete-app');
                        const appId = button.dataset.id;

                        Swal.fire({
                            title: 'Yakin mau dihapus?',
                            text: "Data yang dihapus tidak dapat dikembalikan loh!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#6c757d',
                            confirmButtonText: 'Ya, hapus',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('delete-app-' + appId).submit();
                            }
                        });
                    }
                });
            });
        </script>
    </x-app-layout>
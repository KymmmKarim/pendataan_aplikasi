<x-app-layout>
    <x-slot name="header">
        Application List
    </x-slot>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>

            <div class="d-flex gap-2">
                <form action="{{ route('applications.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" id="search-input" name="search" placeholder="Cari aplikasi..." class="form-control" value="{{ request('search') }}">
                        <span class="input-group-text">
                            <button type="submit" style="border: none; background: none; padding: 0; margin: 0;">
                                <i class="bi bi-search"></i>
                            </button>
                        </span>
                    </div>
                </form>

                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
                    <i></i> Tambah Data
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">
                        <thead class="table-light border-bottom">
                            <tr>
                                <th>Nama Aplikasi</th>
                                <th>Versi</th>
                                <th>Masa Berlaku</th>
                                <th>Unit</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="applications-table-body">
                            @forelse ($applications as $app)
                                <tr>
                                    <td><strong>{{ $app->nama_aplikasi }}</strong></td>
                                    <td>{{ $app->versi }}</td>
                                    <td>
                                        {{ $app->masa_berlaku ? \Carbon\Carbon::parse($app->masa_berlaku)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td>{{ $app->unit->nama ?? '-' }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-outline-dark me-1" title="Lihat Detail">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $app->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form id="delete-app-{{ $app->id }}" action="{{ route('applications.destroy', $app->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-app" data-id="{{ $app->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                @include('applications.partials.modal-edit', ['app' => $app])
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data aplikasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $applications->links() }}
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

            // SweetAlert konfirmasi hapus aplikasi
            document.querySelectorAll('.btn-delete-app').forEach(button => {
                button.addEventListener('click', function () {
                    const appId = this.dataset.id;
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
                });
            });
        });
    </script>
</x-app-layout>
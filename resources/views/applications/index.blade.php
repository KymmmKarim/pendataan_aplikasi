<x-app-layout>
    <x-slot name="header">
        Application List
    </x-slot>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>

            <div class="d-flex gap-2">
                {{-- Search input di atas --}}
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
                    <table class="table custom-table align-middle mb-0" id="applicationsTable">
                        <thead class="table-light border-bottom text-center">
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
                                        {{ $app->masa_berlaku ? \Carbon\Carbon::parse($app->masa_berlaku)->format('d F Y') : '-' }}
                                    </td>
                                    <td>{{ $app->unit->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-outline-dark me-1" title="Lihat Detail">
                                            <i class="bi bi-info-circle"></i>
                                        </a>

                                        @if (
                                            auth()->user()->hasRole('superadmin') ||
                                            auth()->user()->hasRole('admin') ||
                                            (auth()->user()->hasRole('admin-unit') && auth()->user()->unit_id == $app->unit_id)
                                        )
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
                                        @endif
                                    </td>
                                </tr>

                                {{-- Modal Edit --}}
                                @include('applications.partials.modal-edit', ['app' => $app])
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data aplikasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Nonaktifkan pagination Laravel --}}
                {{-- <div class="mt-3">
                    {{ $applications->links() }}
                </div> --}}
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    @include('applications.partials.modal-create')

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables tanpa fitur searching
            $('#applicationsTable').DataTable({
                paging: true,
                ordering: false,
                info: true,
                searching: false, // <== pencarian dimatikan
                pageLength: 10,
                language: {
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });

            // Filter manual berdasarkan search input di atas
            $('#search-input').on('input', function () {
                const keyword = $(this).val().toLowerCase().trim();

                $('#applications-table-body tr').each(function () {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.includes(keyword));
                });
            });

            // SweetAlert konfirmasi hapus
            $('.btn-delete-app').click(function () {
                const appId = $(this).data('id');
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
                        $('#delete-app-' + appId).submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>

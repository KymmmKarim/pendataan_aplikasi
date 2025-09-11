<x-app-layout>
    <x-slot name="header">
        Lokasi Pembelian
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h5 class="mb-0 text-dark fw-semibold">
                    <i class="fas fa-map-marker-alt me-2"></i>Daftar Lokasi Pembelian
                </h5>

                <div class="d-flex gap-2 align-items-center">
                    <div class="input-group input-group-sm" style="max-width: 250px;">
                        <input type="text" id="search-lokasi-input" placeholder="Cari lokasi..." class="form-control">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <a href="{{ route('lokasi_pembelian.create') }}" class="btn btn-primary btn-sm py-1 px-3" style="height: 32px;">
                        Tambah Lokasi
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle w-100" id="lokasiTable">
                        <thead class="table-light text-center text-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="lokasi-table-body">
                            @foreach ($lokasi as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('lokasi_pembelian.edit', $item->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form id="delete-lokasi-{{ $item->id }}" action="{{ route('lokasi_pembelian.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $item->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <script>
        $(document).ready(function () {
            const table = $('#lokasiTable').DataTable({
                paging: true,
                ordering: false,
                info: true,
                searching: false,
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

            $('#search-lokasi-input').on('input', function () {
                const keyword = $(this).val().toLowerCase().trim();
                $('#lokasi-table-body tr').each(function () {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.includes(keyword));
                });
            });

            $('.btn-delete').click(function () {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin mau dihapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-lokasi-' + id).submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>

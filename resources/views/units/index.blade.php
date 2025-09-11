<x-app-layout>
    <x-slot name="header">
        Manajemen Unit
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                <h5 class="mb-0 text-dark fw-semibold">
                    <i class="fas fa-building me-2"></i>Daftar Unit
                </h5>

                <div class="d-flex gap-2 align-items-center">
                    <div class="input-group input-group-sm" style="max-width: 250px;">
                        <input type="text" id="search-unit-input" placeholder="Cari unit..." class="form-control">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <a href="{{ route('units.create') }}" class="btn btn-primary btn-sm py-1 px-3" style="height: 32px;">
                        Tambah Unit
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
                    <table class="table table-bordered table-hover align-middle w-100" id="unitsTable">
                        <thead>
                            <tr>
                                <th></th> 
                                <th>No</th>
                                <th>Nama</th>
                                <th>Singkatan</th>
                                <th>Urut</th>
                                <th>Parent</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td></td>
                                    <td>{{ $unit->no }}</td>
                                    <td>{{ $unit->nama }}</td>
                                    <td>{{ $unit->singkatan }}</td>
                                    <td class="text-center">{{ $unit->urut }}</td>
                                    <td>{{ $unit->parent->nama ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $unit->aktif ? 'success' : 'danger' }}">
                                            {{ $unit->aktif ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap justify-content-center gap-1">
                                            <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-unit-{{ $unit->id }}" action="{{ route('units.destroy', $unit->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-id="{{ $unit->id }}">
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            const table = $('#unitsTable').DataTable({
                paging: true,
                ordering: false,
                info: true,
                searching: true, 
                pageLength: 10,
                responsive: {
                    details: {
                        type: 'column',
                        target: 0, 
                        renderer: function (api, rowIdx, columns) {
                            return $.map(columns, function (col) {
                                return col.hidden
                                    ? `<tr>
                                           <td class="fw-bold">${col.title}</td>
                                           <td>${col.data}</td>
                                       </tr>`
                                    : '';
                            }).join('');
                        }
                    }
                },
                dom: 'lrtip', 
                columnDefs: [
                    { className: 'dtr-control', orderable: false, targets: 0 },
                    { responsivePriority: 1, targets: 1 }, 
                    { responsivePriority: 2, targets: 2 }, 
                    { responsivePriority: 3, targets: -1 }, 
                    { responsivePriority: 10001, targets: [3, 4, 5, 6] }
                ],
                language: {
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });

            $('#search-unit-input').on('keyup', function () {
                table.search(this.value).draw();
            });

            $(document).on('click', '.btn-delete', function () {
                const unitId = $(this).data('id');
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
                        $('#delete-unit-' + unitId).submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>

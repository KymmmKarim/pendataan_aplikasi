<x-app-layout>
    <x-slot name="header">
        Application List
    </x-slot>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Data Aplikasi</h4>

            <div class="d-flex gap-2">
                <form action="{{ route('applications.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari aplikasi..." class="form-control" value="{{ request('search') }}">
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
                                <th>Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $app)
                                <tr>
                                    <td><strong>{{ $app->nama_aplikasi }}</strong></td>
                                    <td>{{ $app->versi }}</td>
                                    <td>{{ $app->kategori }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $app->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('applications.destroy', $app->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
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
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    @include('applications.partials.modal-create')
</x-app-layout>

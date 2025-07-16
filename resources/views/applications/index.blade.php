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
                                        <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-outline-dark me-1" title="Lihat Detail">
                                            <i class="bi bi-info-circle"></i>
                                        </a>
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

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    @include('applications.partials.modal-create')

    {{-- Script agar saat input kosong langsung refresh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('search-input');
            input.addEventListener('input', function() {
                if (input.value === '') {
                    input.form.submit();
                }
            });
        });
    </script>
</x-app-layout>

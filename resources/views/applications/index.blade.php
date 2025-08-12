<x-app-layout>
    <x-slot name="header">
        Application List
    </x-slot>

    {{-- optional: bootstrap icons (masukkan jika belum ada di layout utama) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* ---------- Styling untuk dropdown icon (icon saja, tanpa kotak) ---------- */
       .toggle-detail-btn {
            background: none;      /* hilangkan background */
            border: none;          /* hilangkan border */
            padding: 0;            /* hilangkan padding ekstra */
            margin: 0;
            font-size: 12px;       /* kecilkan ukuran icon */
            line-height: 1;
            color: #6b6b6b;        /* warna icon */
            cursor: pointer;       /* pointer saat hover */
        }

        .toggle-detail-btn i {
            font-size: 12px;       /* kecilkan icon */
            display: inline-block;
            vertical-align: middle;
        }
        .toggle-detail-btn:focus {
            outline: none;
            box-shadow: none;
        }

        /* ---------- Detail row (default hidden); only toggled on mobile ---------- */
        .detail-row {
            display: none; /* default: hidden */
        }
        .detail-cell {
            padding: 10px 12px;
            font-size: 14px;
            background-color: #f8f9fa;
        }

        /* ---------- Mobile adjustments (<=768px) ---------- */
        @media (max-width: 768px) {
            /* Sembunyikan kolom yang tidak diinginkan pada baris utama (Versi, Masa Berlaku, Unit) */
            .col-versi,
            .col-masa,
            .col-unit {
                display: none !important;
            }

            /* Tampilkan detail-row ketika diberi class .show (JS akan toggle class ini) */
            .detail-row.show {
                display: table-row;
            }

            /* Buat tabel lebih rapih di mobile (opsional) */
            table.table {
                font-size: 14px;
            }
        }

        /* Pastikan pada layar besar detail-row tetap tersembunyi */
        @media (min-width: 769px) {
            .detail-row { display: none !important; }
            .toggle-detail-btn { display: none !important; } /* hide toggle icon on desktop */
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
                                <th class="col-versi">Versi</th>
                                <th class="col-masa">Masa Berlaku</th>
                                <th class="col-unit">Unit</th>
                                <th style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="applications-table-body">
                            @forelse ($applications as $app)
                                {{-- Baris utama (pajang nama aplikasi di baris utama) --}}
                                <tr class="main-row" data-id="{{ $app->id }}">
                                    <td>
                                        <span class="me-1">{{ $loop->iteration }}</span>

                                        {{-- Tombol icon (hanya icon, tanpa kotak), berada di sebelah kanan nomor --}}
                                        <button
                                            type="button"
                                            class="toggle-detail-btn d-md-none"
                                            data-id="{{ $app->id }}"
                                            aria-expanded="false"
                                            aria-controls="detail-{{ $app->id }}"
                                            title="Tampilkan detail"
                                        >
                                            <i class="bi-caret-down-fill"></i>
                                        </button>
                                    </td>

                                    {{-- Nama Aplikasi tetap terlihat di main row --}}
                                    <td>{{ $app->nama_aplikasi }}</td>

                                    {{-- Kolom lain (disembunyikan di mobile via class col-*) --}}
                                    <td class="col-versi">{{ $app->versi }}</td>
                                    <td class="col-masa">
                                        {{ $app->masa_berlaku ? \Carbon\Carbon::parse($app->masa_berlaku)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td class="col-unit text-center">{{ $app->unit->nama ?? '-' }}</td>

                                    {{-- Aksi tetap terlihat di baris utama --}}
                                    <td class="text-center">
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

                                {{-- Baris detail (muncul di bawah baris utama ketika tombol icon diklik — hanya di mobile) --}}
                                <tr class="detail-row" id="detail-{{ $app->id }}">
                                    <td colspan="6" class="detail-cell">
                                        <div><strong>Versi:</strong> {{ $app->versi }}</div>
                                        <div><strong>Masa Berlaku:</strong> {{ $app->masa_berlaku ? \Carbon\Carbon::parse($app->masa_berlaku)->translatedFormat('d F Y') : '-' }}</div>
                                        <div><strong>Unit:</strong> {{ $app->unit->nama ?? '-' }}</div>

                                        {{-- Pada bagian detail kita juga tampilkan tombol aksi (opsional), 
                                            tapi karena kamu ingin aksi tetap terlihat di baris utama, saya tidak duplikasi tombol aksi di sini. --}}
                                    </td>
                                </tr>

                                {{-- Modal Edit per item (tetap include) --}}
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
            // Cari (hanya memfilter main-rows; detail-row akan disembunyikan saat filter)
            const searchInput = document.getElementById('search-input');
            const mainRows = document.querySelectorAll('#applications-table-body tr.main-row');

            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();

                mainRows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    const id = row.dataset.id;
                    const detailRow = document.getElementById('detail-' + id);

                    if (keyword === '' || rowText.includes(keyword)) {
                        row.style.display = '';
                        // saat menampilkan main row, tetap sembunyikan detailnya (default)
                        if (detailRow) {
                            detailRow.classList.remove('show');
                            // reset icon
                            const toggleBtn = row.querySelector('.toggle-detail-btn');
                            if (toggleBtn) toggleBtn.innerHTML = '<i class="bi-caret-down-fill"></i>';
                            if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
                        }
                    } else {
                        row.style.display = 'none';
                        if (detailRow) detailRow.classList.remove('show');
                    }
                });
            });

            // Konfirmasi hapus (event delegation)
            document.body.addEventListener('click', function (event) {
                const delBtn = event.target.closest('.btn-delete-app');
                if (delBtn) {
                    const appId = delBtn.dataset.id;

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
                            const form = document.getElementById('delete-app-' + appId);
                            if (form) form.submit();
                        }
                    });
                }
            });

            // Toggle detail row (ikon di sebelah kanan nomor)
            document.querySelectorAll('.toggle-detail-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const detailRow = document.getElementById('detail-' + id);
                    if (!detailRow) return;

                    const isShown = detailRow.classList.toggle('show'); // toggle class .show
                    this.setAttribute('aria-expanded', isShown ? 'true' : 'false');

                    // ubah ikon accordingly
                    this.innerHTML = isShown ? '<i class="bi-caret-up-fill"></i>' : '<i class="bi-caret-down-fill"></i>';
                });
            });
        });
    </script>
</x-app-layout>
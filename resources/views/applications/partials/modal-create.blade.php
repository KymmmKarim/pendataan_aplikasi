<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Tambah Data</h4>

            <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nama_aplikasi" class="form-label fw-semibold">Nama Aplikasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_aplikasi" id="nama_aplikasi" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                        <input type="text" name="harga" id="harga" class="form-control border-dark" placeholder="Masukkan Harga" required>
                    </div>
                    <div class="col-md-6">
                        <label for="versi" class="form-label fw-semibold">Versi <span class="text-danger">*</span></label>
                        <input type="text" name="versi" id="versi" class="form-control border-dark" placeholder="Masukkan Versi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi_pembelian_id" class="form-label fw-semibold">Lokasi Pembelian <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2">
                            <select name="lokasi_pembelian_id" id="lokasi_pembelian_id" class="form-control border-dark select2-lokasi" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach ($lokasiPembelians as $lokasi)
                                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalLokasiBaru">+</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="masa_berlaku" class="form-label fw-semibold">Masa Berlaku <span class="text-danger">*</span></label>
                        <input type="date" name="masa_berlaku" id="masa_berlaku" class="form-control border-dark" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_pembelian" class="form-label fw-semibold">Tanggal Pembelian <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control border-dark" required>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control border-dark" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="bukti_pembelian" class="form-label fw-semibold">Bukti Pembelian <span class="text-danger">*</span></label>
                        <input type="file" name="bukti_pembelian" id="bukti_pembelian" class="form-control border-dark" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control border-dark" placeholder="Masukkan Deskripsi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="unit_id" class="form-label fw-semibold">Pilih Unit <span class="text-danger">*</span></label>
                        @role('admin-unit')
                            <select class="form-control border-dark" disabled>
                                <option>{{ auth()->user()->unit->nama }}</option>
                            </select>
                            <input type="hidden" name="unit_id" value="{{ auth()->user()->unit_id }}">
                        @else
                            <select name="unit_id" id="unit_id" class="form-control border-dark select2-unit" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                @endforeach
                            </select>
                        @endrole
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Lokasi Pembelian -->
<div class="modal fade" id="modalLokasiBaru" tabindex="-1" aria-labelledby="modalLokasiBaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4 border-0 shadow">
            <h5 class="modal-title mb-3 fw-bold text-primary" id="modalLokasiBaruLabel">Tambah Lokasi Pembelian</h5>

            <div class="mb-3">
                <label for="nama_lokasi_baru" class="form-label fw-semibold">Nama Lokasi</label>
                <input type="text" id="nama_lokasi_baru" class="form-control border-dark" placeholder="Masukkan nama lokasi">
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="simpan_lokasi" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .select2-container--default .select2-selection--single {
            height: 38px !important;
            border: 1px solid #000 !important;
            border-radius: 0.375rem !important;
            padding: 6px 12px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#unit_id').select2({
                dropdownParent: $('#tambahData'),
                placeholder: "-- Pilih Unit --",
                width: '100%',
                allowClear: true
            });

            $('#lokasi_pembelian_id').select2({
                dropdownParent: $('#tambahData'),
                placeholder: "-- Pilih Lokasi --",
                width: '100%',
                allowClear: true
            });

            $('#simpan_lokasi').click(function () {
                var nama = $('#nama_lokasi_baru').val();

                if (!nama) {
                    alert('Nama lokasi tidak boleh kosong');
                    return;
                }

                $.ajax({
                    url: '{{ route("lokasi-pembelian.ajax-store") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: nama
                    },
                    success: function (res) {
                        if (res.status === 'success') {
                            let newOption = new Option(res.lokasi.nama, res.lokasi.id, true, true);
                            $('#lokasi_pembelian_id').append(newOption).trigger('change');

                            $('#modalLokasiBaru').modal('hide');
                            $('#nama_lokasi_baru').val('');
                        }
                    },
                    error: function () {
                        alert('Gagal menyimpan lokasi pembelian');
                    }
                });
            });
        });
    </script>
@endpush

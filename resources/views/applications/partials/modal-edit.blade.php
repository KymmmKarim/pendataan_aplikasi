<!-- Modal Edit Data -->
<div class="modal fade" id="modalEdit{{ $app->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $app->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Edit Data</h4>

            <form method="POST" action="{{ route('applications.update', $app->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="nama_aplikasi_{{ $app->id }}" class="form-label fw-semibold">Nama Aplikasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_aplikasi" id="nama_aplikasi_{{ $app->id }}" value="{{ $app->nama_aplikasi }}" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="harga_{{ $app->id }}" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                        <input type="text" name="harga" id="harga_{{ $app->id }}" value="{{ $app->harga }}" class="form-control border-dark" placeholder="Masukkan Harga" required>
                    </div>
                    <div class="col-md-6">
                        <label for="versi_{{ $app->id }}" class="form-label fw-semibold">Versi <span class="text-danger">*</span></label>
                        <input type="text" name="versi" id="versi_{{ $app->id }}" value="{{ $app->versi }}" class="form-control border-dark" placeholder="Masukkan Versi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lokasi_pembelian_id_{{ $app->id }}" class="form-label fw-semibold">Lokasi Pembelian <span class="text-danger">*</span></label>
                        <select name="lokasi_pembelian_id" id="lokasi_pembelian_id_{{ $app->id }}" class="form-control border-dark select2-lokasi" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach ($lokasiPembelians as $lokasi)
                                <option value="{{ $lokasi->id }}" {{ $app->lokasi_pembelian_id == $lokasi->id ? 'selected' : '' }}>
                                    {{ $lokasi->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="masa_berlaku_{{ $app->id }}" class="form-label fw-semibold">Masa Berlaku <span class="text-danger">*</span></label>
                        <input type="date" name="masa_berlaku" id="masa_berlaku_{{ $app->id }}" value="{{ $app->masa_berlaku }}" class="form-control border-dark" required>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal_pembelian_{{ $app->id }}" class="form-label fw-semibold">Tanggal Pembelian <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian_{{ $app->id }}" value="{{ $app->tanggal_pembelian }}" class="form-control border-dark" required>
                    </div>
                    <div class="col-md-6">
                        <label for="status_{{ $app->id }}" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status_{{ $app->id }}" class="form-control border-dark" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ $app->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non-Aktif" {{ $app->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="bukti_pembelian_{{ $app->id }}" class="form-label fw-semibold">Bukti Pembelian</label>
                        <input type="file" name="bukti_pembelian" id="bukti_pembelian_{{ $app->id }}" class="form-control border-dark" accept=".jpg,.jpeg,.png,.pdf">
                        @if ($app->bukti_pembelian)
                            <small class="d-block mt-1">
                                File saat ini: <a href="{{ asset('storage/' . $app->bukti_pembelian) }}" target="_blank">Lihat</a>
                            </small>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsi_{{ $app->id }}" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <input type="text" name="deskripsi" id="deskripsi_{{ $app->id }}" value="{{ $app->deskripsi }}" class="form-control border-dark" placeholder="Masukkan Deskripsi" required>
                    </div>
                    <div class="col-md-6">
                        <label for="unit_id_{{ $app->id }}" class="form-label fw-semibold">Pilih Unit <span class="text-danger">*</span></label>
                        @role('admin-unit')
                            <select class="form-control border-dark" disabled>
                                <option>{{ auth()->user()->unit->nama }}</option>
                            </select>
                            <input type="hidden" name="unit_id" value="{{ auth()->user()->unit_id }}">
                        @else
                            <select name="unit_id" id="unit_id_{{ $app->id }}" class="form-control border-dark select2-unit" required>
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $app->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama }}
                                    </option>
                                @endforeach
                            </select>
                        @endrole
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
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
            $('#unit_id_{{ $app->id }}').select2({
                dropdownParent: $('#modalEdit{{ $app->id }}'),
                placeholder: "-- Pilih Unit --",
                width: '100%',
                allowClear: true
            });
            $('#lokasi_pembelian_id_{{ $app->id }}').select2({
                dropdownParent: $('#modalEdit{{ $app->id }}'),
                placeholder: "-- Pilih Lokasi --",
                width: '100%',
                allowClear: true
            });
        });
    </script>
@endpush
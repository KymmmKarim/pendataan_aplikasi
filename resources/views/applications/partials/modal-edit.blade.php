<div class="modal fade" id="modalEdit{{ $app->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $app->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Edit Data</h4>

            <form method="POST" action="{{ route('applications.update', $app->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Aplikasi</label>
                        <input type="text" name="nama_aplikasi" value="{{ $app->nama_aplikasi }}" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga</label>
                        <input type="text" name="harga" value="{{ $app->harga }}" class="form-control border-dark" placeholder="Masukkan Harga" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Versi</label>
                        <input type="text" name="versi" value="{{ $app->versi }}" class="form-control border-dark" placeholder="Masukkan Versi">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lokasi Pembelian</label>
                        <select name="lokasi_pembelian" class="form-control border-dark" required>
                            <option value="">Pilih Lokasi Pembelian</option>
                            <option value="Official" {{ $app->lokasi_pembelian == 'Official' ? 'selected' : '' }}>Official</option>
                            <option value="E-Commerce" {{ $app->lokasi_pembelian == 'E-Commerce' ? 'selected' : '' }}>E-Commerce</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Masa Berlaku</label>
                        <input type="date" name="masa_berlaku" value="{{ $app->masa_berlaku }}" class="form-control border-dark">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" value="{{ $app->tanggal_pembelian }}" class="form-control border-dark" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-control border-dark" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif" {{ $app->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non-Aktif" {{ $app->status == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Bukti Pembelian</label>
                        <input type="file" name="bukti_pembelian" class="form-control border-dark" accept=".jpg,.jpeg,.png,.pdf">
                        @if ($app->bukti_pembelian)
                            <small class="d-block mt-1">
                                File saat ini: <a href="{{ asset('storage/' . $app->bukti_pembelian) }}" target="_blank">Lihat</a>
                            </small>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ $app->deskripsi }}" class="form-control border-dark" placeholder="Masukkan Deskripsi" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Pilih Unit <span class="text-danger">*</span></label>
                        <select name="unit_id" id="unit_id_{{ $app->id }}" class="form-control border-dark select2-unit" required>
                            <option value="">-- Pilih Unit --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ $app->unit_id == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->nama }}
                                </option>
                            @endforeach
                        </select>
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

<!-- Select2 CSS & JS Langsung -->
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
        $('#modalEdit{{ $app->id }} .select2-unit').select2({
            dropdownParent: $('#modalEdit{{ $app->id }}'),
            placeholder: "-- Pilih Unit --",
            width: '100%',
            allowClear: true
        });
    });
</script>

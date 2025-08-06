<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-4 border-0 shadow">
            <h4 class="mb-4 fw-bold text-primary">Tambah Data</h4>

            <form id="formTambah" method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Nama Aplikasi -->
                    <div class="col-md-6">
                        <label for="nama_aplikasi" class="form-label fw-semibold">Nama Aplikasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_aplikasi" id="nama_aplikasi" class="form-control border-dark" placeholder="Masukkan Nama Aplikasi" required>
                    </div>

                    <!-- Harga -->
                    <div class="col-md-6">
                        <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                        <input type="text" name="harga" id="harga" class="form-control border-dark" placeholder="Masukkan Harga" required>
                    </div>

                    <!-- Versi -->
                    <div class="col-md-6">
                        <label for="versi" class="form-label fw-semibold">Versi <span class="text-danger">*</span></label>
                        <input type="text" name="versi" id="versi" class="form-control border-dark" placeholder="Masukkan Versi" required>
                    </div>

                    <!-- Lokasi Pembelian -->
                    <div class="col-md-6">
                        <label for="lokasi_pembelian_id" class="form-label fw-semibold">Lokasi Pembelian <span class="text-danger">*</span></label>
                        <select name="lokasi_pembelian_id" id="lokasi_pembelian_id" class="form-control border-dark" required>
                            <option></option>
                            @foreach ($lokasiPembelians as $lokasi)
                                <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Masa Berlaku -->
                    <div class="col-md-6">
                        <label for="masa_berlaku" class="form-label fw-semibold">Masa Berlaku <span class="text-danger">*</span></label>
                        <input type="date" name="masa_berlaku" id="masa_berlaku" class="form-control border-dark" required>
                    </div>

                    <!-- Tanggal Pembelian -->
                    <div class="col-md-6">
                        <label for="tanggal_pembelian" class="form-label fw-semibold">Tanggal Pembelian <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control border-dark" required>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control border-dark" required>
                            <option value="">Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non-Aktif">Non-Aktif</option>
                        </select>
                    </div>

                    <!-- Bukti Pembelian -->
                    <div class="col-md-6">
                        <label for="bukti_pembelian" class="form-label fw-semibold">Bukti Pembelian <span class="text-danger">*</span></label>
                        <input type="file" name="bukti_pembelian" id="bukti_pembelian" class="form-control border-dark" accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-md-6">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control border-dark" placeholder="Masukkan Deskripsi" required>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-6">
                        <label for="unit_id" class="form-label fw-semibold">Pilih Unit <span class="text-danger">*</span></label>
                        @role('admin-unit')
                            <select class="form-control border-dark" disabled>
                                <option>{{ auth()->user()->unit->nama }}</option>
                            </select>
                            <input type="hidden" name="unit_id" value="{{ auth()->user()->unit_id }}">
                        @else
                            <select name="unit_id" id="unit_id" class="form-control border-dark select2-unit" required>
                                <option value="">Pilih Unit</option>
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
    // Format harga
    $('#harga').on('input', function () {
        let value = this.value.replace(/\D/g, '');
        this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
    });

    $('#harga').on('keypress', function (e) {
        if (!/[0-9]/.test(e.key)) e.preventDefault();
    });

    // Saat modal tampil, inisialisasi Select2 (hanya sekali)
    $('#tambahData').on('shown.bs.modal', function () {
        const $unit = $('#unit_id');
        const $lokasi = $('#lokasi_pembelian_id');

        if (!$unit.hasClass("select2-hidden-accessible")) {
            $unit.select2({
                dropdownParent: $('#tambahData'),
                width: '100%',
                allowClear: true
            });
        }

        if (!$lokasi.hasClass("select2-hidden-accessible")) {
            $lokasi.select2({
                dropdownParent: $('#tambahData'),
                width: '100%',
                allowClear: true,
                placeholder: "Pilih atau Tambah Lokasi",
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    return term ? { id: 'new:' + term, text: term, newOption: true } : null;
                },
                templateResult: function (data) {
                    var $result = $("<span></span>").text(data.text);
                    if (data.newOption) $result.append(" <em>(tambah lokasi baru)</em>");
                    return $result;
                }
            });
        }
    });

    // Submit form tambah data
    $('#formTambah').on('submit', function (e) {
        e.preventDefault();

        var selected = $('#lokasi_pembelian_id').val();
        var form = this;

        if (selected && selected.startsWith('new:')) {
            let namaBaru = selected.slice(4);
            $.ajax({
                url: '{{ route("lokasi-pembelian.ajax-store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama: namaBaru
                },
                success: function (res) {
                    if (res.status === 'success') {
                        let newOption = new Option(res.lokasi.nama, res.lokasi.id, true, true);
                        $('#lokasi_pembelian_id').append(newOption).trigger('change');
                        $('#formTambah').submit();
                    } else {
                        alert('Gagal menyimpan lokasi.');
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat menyimpan lokasi.');
                }
            });
            return;
        }

        let formData = new FormData(form);

        $.ajax({
            url: $(form).attr('action'),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === 'success') {
                    const formattedDate = response.masa_berlaku
                        ? new Date(response.masa_berlaku).toLocaleDateString('id-ID', {
                            day: '2-digit', month: 'long', year: 'numeric'
                        }) : '-';

                    const newRow = `
                        <tr>
                            <td><strong>${response.nama_aplikasi}</strong></td>
                            <td>${response.versi ?? '-'}</td>
                            <td>${formattedDate}</td>
                            <td class="text-center">${response.unit_nama ?? '-'}</td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="/applications/${response.id}" class="btn btn-sm btn-outline-dark" title="Lihat Detail">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit${response.id}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form id="delete-app-${response.id}" action="/applications/${response.id}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-app" data-id="${response.id}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;

                    $('#applications-table-body').prepend(newRow);
                    $('#tambahData').modal('hide');
                    form.reset();
                    $('#lokasi_pembelian_id, #unit_id').val(null).trigger('change');

                    // SweetAlert success
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let pesan = Object.values(errors).map(err => err[0]).join('\n');
                    alert(pesan);
                } else {
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            }
        });
    });
});
</script>
@endpush
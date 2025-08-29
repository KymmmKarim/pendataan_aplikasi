<x-app-layout>
    <x-slot name="header">
        Edit Unit
    </x-slot>

    <!-- Select2 CSS untuk samakan ukuran dropdown -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('units.update', $unit->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No <span class="text-danger">*</span></label>
                            <input type="text" name="no" class="form-control" value="{{ old('no', $unit->no) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $unit->nama) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Singkatan <span class="text-danger">*</span></label>
                            <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan', $unit->singkatan) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Urut</label>
                            <input type="number" name="urut" class="form-control" value="{{ old('urut', $unit->urut) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Induk Unit</label>
                            <select name="parent_id" id="parent_id" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $unit->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <select name="aktif" class="form-select">
                                <option value="">Masukan Status </option>
                                <option value="1" {{ old('aktif', $unit->aktif) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('aktif', $unit->aktif) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('units.index') }}" class="btn btn-outline-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#parent_id').select2({
                placeholder: "Pilih Induk Unit",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</x-app-layout>

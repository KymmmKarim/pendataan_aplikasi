<x-app-layout>
    <x-slot name="header">
        Edit Unit
    </x-slot>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('units.update', $unit->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No</label>
                            <input type="text" name="no" class="form-control" value="{{ old('no', $unit->no) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $unit->nama) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Singkatan</label>
                            <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan', $unit->singkatan) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urut</label>
                            <input type="number" name="urut" class="form-control" value="{{ old('urut', $unit->urut) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Induk Unit</label>
                            <select name="parent_id" class="form-select">
                                <option value="">-- Tidak Ada --</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $unit->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="aktif" class="form-select">
                                <option value="1" {{ old('aktif', $unit->aktif) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('aktif', $unit->aktif) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('units.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

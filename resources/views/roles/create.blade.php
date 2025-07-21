<x-app-layout>
    <x-slot name="header">
        Tambah Role & Permission
    </x-slot>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    <!-- Role Section -->
                    <h5 class="fw-bold">1. Data Role</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="cth: admin" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="guard_name" class="form-label">Guard Name <span class="text-danger">*</span></label>
                            <input type="text" name="guard_name" id="guard_name" class="form-control @error('guard_name') is-invalid @enderror" value="web" required>
                            @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <!-- Permissions Section -->
                    <h5 class="fw-bold">2. Hak Akses (Permissions)</h5>
                    <div class="row mb-4">
                        @forelse ($permissions as $permission)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="permissions[]"
                                        id="perm_{{ $permission->id }}"
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                        {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                    </label>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Belum ada permission tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                             Simpan
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary ms-2">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

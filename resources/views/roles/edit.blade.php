<x-app-layout>
    <x-slot name="header">
        Edit Role & Permission
    </x-slot>

    <div class="container-fluid mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Role Section --}}
                    <h6 class="fw-bold mb-3">1. Data Role</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                id="name"
                                placeholder="Contoh: admin"
                                value="{{ old('name', $role->name) }}"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="guard_name" class="form-label">Guard Name <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control @error('guard_name') is-invalid @enderror"
                                name="guard_name"
                                id="guard_name"
                                placeholder="web"
                                value="{{ old('guard_name', $role->guard_name) }}"
                                required
                            >
                            @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Permission Section --}}
                    <h6 class="fw-bold mb-3">2. Hak Akses (Permissions)</h6>
                    <div class="row">
                        @forelse ($permissions as $permission)
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="permissions[]"
                                        id="perm_{{ $permission->id }}"
                                        value="{{ $permission->name }}"
                                        {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}
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

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                             Simpan Perubahan
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                             Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

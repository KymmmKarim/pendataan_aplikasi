<x-app-layout>
    <x-slot name="header">
        Edit Role & Permission
    </x-slot>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <h5 class="fw-bold">1. Data Role</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan Nama Role"
                                value="{{ old('name', $role->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="guard_name" class="form-label">Guard Name <span class="text-danger">*</span></label>
                            <input type="text" name="guard_name" id="guard_name"
                                class="form-control @error('guard_name') is-invalid @enderror"
                                value="{{ old('guard_name', $role->guard_name) }}" required>
                            @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <!-- Permissions Section -->
                    <h5 class="fw-bold">2. Hak Akses (Permissions)</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                        + Tambah Permission
                    </button>

                    <div class="row mb-4" id="permissionList">
                        @forelse ($permissions as $permission)
                            <div class="col-md-4 mb-2 permission-item" id="perm_wrapper_{{ $permission->id }}">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input me-2" type="checkbox"
                                        name="permissions[]"
                                        id="perm_{{ $permission->id }}"
                                        value="{{ $permission->name }}"
                                        {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                    <label class="form-check-label me-auto" for="perm_{{ $permission->id }}">
                                        {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                    </label>
                                    <button type="button" class="btn btn-sm p-0 ms-2 btn-delete-permission"
                                        style="background: none; border: none; color: black; font-size: 1.2rem;"
                                        data-id="{{ $permission->id }}">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Belum ada permission tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="addPermissionForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Permission Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="permissionName" class="form-label">Nama Permission</label>
                            <input type="text" class="form-control" id="permissionName" name="name" required>
                            <div class="invalid-feedback" id="permissionError"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('addPermissionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('permissionName').value;
            const errorEl = document.getElementById('permissionError');
            errorEl.textContent = '';
            errorEl.style.display = 'none';

            fetch("{{ route('permissions.ajax.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name: name })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => { throw data; });
                }
                return response.json();
            })
            .then(data => {
                const wrapperId = `perm_wrapper_${data.permission.id}`;
                const permId = `perm_${data.permission.id}`;
                const labelText = data.permission.name
                    .replace(/_/g, ' ')
                    .replace(/\b\w/g, c => c.toUpperCase());

                const checkboxHTML = `
                    <div class="col-md-4 mb-2 permission-item" id="${wrapperId}">
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox"
                                name="permissions[]" id="${permId}"
                                value="${data.permission.name}" checked>
                            <label class="form-check-label me-auto" for="${permId}">
                                ${labelText}
                            </label>
                            <button type="button" class="btn btn-sm p-0 ms-2 btn-delete-permission"
                                style="background: none; border: none; color: black; font-size: 1.2rem;"
                                data-id="${data.permission.id}">
                                &times;
                            </button>
                        </div>
                    </div>
                `;

                document.getElementById('permissionList').insertAdjacentHTML('beforeend', checkboxHTML);

                document.getElementById('permissionName').value = '';
                const modal = bootstrap.Modal.getInstance(document.getElementById('addPermissionModal'));
                modal.hide();
            })
            .catch(err => {
                errorEl.textContent = err.message || 'Terjadi kesalahan.';
                errorEl.style.display = 'block';
            });
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-delete-permission')) {
                const permissionId = e.target.dataset.id;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Permission akan dihapus secara permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/permissions/${permissionId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal menghapus permission');
                            document.getElementById(`perm_wrapper_${permissionId}`).remove();
                        })
                        .catch(error => {
                            Swal.fire('Gagal!', error.message, 'error');
                        });
                    }
                });
            }
        });
    </script>
</x-app-layout>

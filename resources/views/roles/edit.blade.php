<x-app-layout>
    <x-slot name="header">
        Edit Role
    </x-slot>

    <div class="container mt-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Role -->
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Role</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
                    </div>

                    <!-- Permissions -->
                    <div class="mb-3">
                        <h5><strong>2. Hak Akses (Permissions)</strong></h5>
                        <button type="button" class="btn btn-sm btn-outline-primary mb-2" id="btn-add-permission">
                            + Tambah Permission
                        </button>

                        <div class="row" id="permissions-container">
                            @foreach($permissions as $permission)
                                <div class="col-md-4 mb-2 permission-item" id="perm_wrapper_{{ $permission->id }}">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox"
                                            name="permissions[]" id="perm_{{ $permission->id }}"
                                            value="{{ $permission->name }}"
                                            {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label me-auto" for="perm_{{ $permission->id }}">
                                            {{ ucfirst(str_replace('_', ' ', $permission->name)) }}
                                        </label>
                                        <button type="button"
                                            class="btn btn-sm p-0 ms-2 btn-delete-permission"
                                            style="background: none; border: none; color: black; font-size: 1.2rem;"
                                            data-id="{{ $permission->id }}">
                                            &times;
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('btn-add-permission').addEventListener('click', function () {
            Swal.fire({
                title: 'Tambah Permission Baru',
                input: 'text',
                inputLabel: 'Nama Permission',
                inputPlaceholder: 'contoh: edit_data',
                showCancelButton: true,
                confirmButtonText: 'Tambah',
                cancelButtonText: 'Batal',
                preConfirm: (value) => {
                    if (!value) return Swal.showValidationMessage('Permission tidak boleh kosong');
                    return fetch('{{ route('permissions.ajax.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ name: value })
                    }).then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                throw new Error(data.message || 'Gagal menambah permission');
                            });
                        }
                        return response.json();
                    });
                }
            }).then(result => {
                if (result.isConfirmed && result.value) {
                    const permission = result.value;
                    const container = document.getElementById('permissions-container');
                    const html = `
                        <div class="col-md-4 mb-2 permission-item" id="perm_wrapper_${permission.id}">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2" type="checkbox"
                                    name="permissions[]" id="perm_${permission.id}"
                                    value="${permission.name}" checked>
                                <label class="form-check-label me-auto" for="perm_${permission.id}">
                                    ${permission.name.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}
                                </label>
                                <button type="button"
                                    class="btn btn-sm p-0 ms-2 btn-delete-permission"
                                    style="background: none; border: none; color: black; font-size: 1.2rem;"
                                    data-id="${permission.id}">
                                    &times;
                                </button>
                            </div>
                        </div>`;
                    container.insertAdjacentHTML('beforeend', html);
                }
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

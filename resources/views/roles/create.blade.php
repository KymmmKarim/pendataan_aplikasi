<x-app-layout>
    <x-slot name="header">
        Tambah Role & Permission
    </x-slot>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf

                    <!-- Form Role -->
                    <h5 class="fw-bold">1. Tambah Role</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="role_name" class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <input type="text" name="role_name" id="role_name" class="form-control" placeholder="cth: admin" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role_guard" class="form-label">Guard Name <span class="text-danger">*</span></label>
                            <input type="text" name="role_guard" id="role_guard" class="form-control" value="web" required>
                        </div>
                    </div>

                    <hr>

                    <!-- Form Permission -->
                    <h5 class="fw-bold">2. Tambah Permission</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="permission_name" class="form-label">Nama Permission <span class="text-danger">*</span></label>
                            <input type="text" name="permission_name" id="permission_name" class="form-control" placeholder="cth: lihat data" required>
                        </div>
                        <div class="col-md-6">
                            <label for="permission_guard" class="form-label">Guard Name <span class="text-danger">*</span></label>
                            <input type="text" name="permission_guard" id="permission_guard" class="form-control" value="web" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
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

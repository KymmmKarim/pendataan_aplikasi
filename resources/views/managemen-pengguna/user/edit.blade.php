<x-app-layout>
    <x-slot name="header">
        Edit Pengguna
    </x-slot>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <!-- Data Diri -->
                <h6 class="fw-bold mb-3">1. Data Diri</h6>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="ex. Admin Itenas">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="admin@example.com">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" placeholder="ex. adminitenas">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" placeholder="****">
                    </div>
                </div>

                <hr>

                <!-- Hak Akses -->
                <h6 class="fw-bold mb-3">2. Hak Akses (Role)</h6>
                <div class="row">
                    <div class="col-md-6">
                        @foreach (['admin', 'prodi', 'kaprodi', 'bka', 'w_rektor'] as $role)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="role" id="role_{{ $role }}" value="{{ $role }}">
                            <label class="form-check-label" for="role_{{ $role }}">
                                {{ ucfirst(str_replace('_', ' ', $role)) }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @foreach (['pembimbing', 'penguji', 'mahasiswa'] as $role)
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="role" id="role_{{ $role }}" value="{{ $role }}">
                            <label class="form-check-label" for="role_{{ $role }}">
                                {{ ucfirst(str_replace('_', ' ', $role)) }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">
                        <i></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        Tambah Pengguna
    </x-slot>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <!-- Data Diri -->
                    <h6 class="fw-bold mb-3">1. Data Diri</h6>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                        </div>

                        <!-- Kolom Unit -->
                        <div class="col-md-6 mb-3">
                            <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                            <select class="form-select" id="unit" name="unit" required>
                                <option value="" disabled selected>-- Pilih Unit --</option>
                                <option value="UPT-TIK">UPT-TIK</option>
                                <option value="unit-a">Unit A</option>
                                <option value="unit-b">Unit B</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <!-- Hak Akses -->
                    <h6 class="fw-bold mb-3">2. Hak Akses (Role)</h6>
                    <div class="row">
                        @foreach ($roles->chunk(ceil($roles->count() / 2)) as $chunk)
                            <div class="col-md-6">
                                @foreach ($chunk as $role)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="role" id="role_{{ $role->name }}"
                                            value="{{ $role->name }}"
                                            {{ isset($user) && $user->roles->first()?->name === $role->name ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="role_{{ $role->name }}">
                                            {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>


                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                             Simpan
                        </button>
                         <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

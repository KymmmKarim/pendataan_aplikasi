<x-app-layout>
    <x-slot name="header">
        Tambah Pengguna
    </x-slot>

    <!-- Select2 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                        <div class="col-md-6 mb-3" id="unit-select-container" style="display: none;">
                            <label for="unit" class="form-label">Pilih Unit <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="unit" name="unit">
                                <option value="" disabled selected>-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                @endforeach
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const unitSelectContainer = document.getElementById('unit-select-container');

            // Inisialisasi Select2
            $(document).ready(function () {
                $('#unit').select2({
                    placeholder: "-- Pilih Unit --",
                    allowClear: true,
                    width: '100%'
                });
            });

            function toggleUnitSelect() {
                const selectedRole = document.querySelector('input[name="role"]:checked');
                if (selectedRole && selectedRole.value === 'admin-unit') {
                    unitSelectContainer.style.display = 'block';
                } else {
                    unitSelectContainer.style.display = 'none';
                    $('#unit').val(null).trigger('change');
                }
            }

            roleRadios.forEach(radio => {
                radio.addEventListener('change', toggleUnitSelect);
            });

            toggleUnitSelect(); // jalankan sekali saat halaman load
        });
    </script>
    @endpush

</x-app-layout>

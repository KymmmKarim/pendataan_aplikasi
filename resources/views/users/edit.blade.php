<x-app-layout>
    <x-slot name="header">
        Edit Pengguna
    </x-slot>

    <!-- Load Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="container-fluid mt-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- SECTION 1: Data Diri -->
                    <h6 class="fw-bold mb-3">1. Data Diri</h6>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name', $user->name) }}" placeholder="ex. Admin Itenas" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email', $user->email) }}" placeholder="admin@example.com" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" id="username"
                                value="{{ old('username', $user->username) }}" placeholder="ex. adminitenas" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="*******">
                        </div>

                        <!-- Dropdown Unit -->
                        <div class="col-md-6 mb-3" id="unit-select-container" style="display: none;">
                            <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                            <select name="unit" id="unit" class="form-select select2" style="width: 100%;">
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ old('unit', $user->unit_id) == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>

                    <!-- SECTION 2: Hak Akses -->
                    <h6 class="fw-bold mb-3">2. Hak Akses (Role)</h6>
                    <div class="row">
                        @foreach ($roles->chunk(ceil($roles->count() / 2)) as $chunk)
                            <div class="col-md-6">
                                @foreach ($chunk as $role)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="role" id="role_{{ $role->name }}"
                                            value="{{ $role->name }}"
                                            {{ $user->roles->first()?->name === $role->name ? 'checked' : '' }}>
                                        <label class="form-check-label" for="role_{{ $role->name }}">
                                            {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <button class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {
            // Inisialisasi Select2
            $('#unit').select2({
                placeholder: "-- Pilih Unit --",
                allowClear: true,
                width: '100%'
            });

            const roleRadios = $('input[name="role"]');
            const unitSelectContainer = $('#unit-select-container');

            function toggleUnitSelect() {
                const selectedRole = $('input[name="role"]:checked').val();
                if (selectedRole === 'admin-unit') {
                    unitSelectContainer.show();
                } else {
                    unitSelectContainer.hide();
                    $('#unit').val(null).trigger('change');
                }
            }

            roleRadios.change(toggleUnitSelect);
            toggleUnitSelect(); // Jalankan saat halaman pertama kali dibuka
        });
    </script>
    @endpush
</x-app-layout>

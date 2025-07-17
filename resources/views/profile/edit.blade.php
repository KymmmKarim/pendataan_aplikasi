<x-app-layout>
    <x-slot name="header">
        Profile
    </x-slot>

    <div class="container mt-4">
        <h4 class="fw-bold mb-4">Informasi Pribadi</h4>

        <!-- Form Update Profil -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card mb-4">
                <div class="card-body d-flex flex-wrap align-items-start">
                    <!-- Foto -->
                    <div class="me-4 text-center">
                        <img
                            id="preview-image"
                            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('img/default-user.jpg') }}"
                            width="100"
                            height="100"
                            class="rounded-circle border"
                            style="object-fit: cover;"
                            alt="Foto Profil">
                    </div>

                    <!-- Nama dan aksi -->
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="fw-semibold mb-0" id="display-name">{{ Auth::user()->name }}</p>
                            <a href="#" id="edit-name-btn" class="text-primary small">Edit Nama</a>
                        </div>

                        <div id="name-input-wrapper" class="d-none mb-2">
                            <input type="text" name="name" id="name-input" class="form-control form-control-sm w-75"
                                   value="{{ old('name', Auth::user()->name) }}">
                        </div>

                        @if (!Auth::user()->photo)
                            <p id="photo-note" class="text-danger small">Anda dapat menambahkan foto anda sendiri bila mau.</p>
                        @endif

                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-sm btn-primary" onclick="triggerFileInput()">Unggah Foto</button>

                            @if (Auth::user()->photo)
                                <a href="{{ route('profile.photo.delete') }}" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Yakin ingin menghapus foto?')">
                                    Hapus Foto
                                </a>
                            @endif
                        </div>

                        <!-- Hidden File Input -->
                        <input type="file" name="photo" id="photo" class="d-none" accept="image/*" onchange="previewImage(event)">
                        @error('photo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror

                        <div id="save-button-wrapper" class="mt-3 d-none">
                            <button class="btn btn-sm btn-success" type="submit">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Informasi Profil -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><strong>Informasi Profil</strong></span>
        <a href="#" class="text-primary" id="edit-profile-info">Edit Informasi Profil</a>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-2">
                <strong>Nama lengkap:</strong>
                <p>{{ Auth::user()->name }}</p>
            </div>

            <div class="mb-2">
                <strong>Email:</strong>
                <p id="email-display">{{ Auth::user()->email }}</p>

                <input type="email" name="email" id="email-input" class="form-control form-control-sm w-50 d-none"
                       value="{{ old('email', Auth::user()->email) }}">
                @error('email')
                <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <strong>Role:</strong>
                <p>{{ Auth::user()->getRoleNames()->first() ?? '-' }}</p>
            </div>

            <div id="save-profile-info" class="mt-2 d-none">
                <button type="submit" class="btn btn-sm btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>


    @push('scripts')
        <script>
document.getElementById('edit-profile-info').addEventListener('click', function (e) {
        e.preventDefault();

        const emailDisplay = document.getElementById('email-display');
        const emailInput = document.getElementById('email-input');
        const saveButton = document.getElementById('save-profile-info');

        if (emailDisplay && emailInput && saveButton) {
            emailDisplay.classList.add('d-none');
            emailInput.classList.remove('d-none');
            saveButton.classList.remove('d-none');
            this.classList.add('d-none'); // sembunyikan tombol edit
        }
    });

            function triggerFileInput() {
                document.getElementById('photo').click();
            }

            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        document.getElementById('preview-image').src = reader.result;
                        document.getElementById('save-button-wrapper').classList.remove('d-none');
                        const note = document.getElementById('photo-note');
                        if (note) note.classList.add('d-none');
                    };
                    reader.readAsDataURL(file);
                }
            }

            document.getElementById('edit-name-btn').addEventListener('click', function (e) {
                e.preventDefault();
                document.getElementById('display-name').classList.add('d-none');
                document.getElementById('name-input-wrapper').classList.remove('d-none');
                document.getElementById('save-button-wrapper').classList.remove('d-none');
                this.classList.add('d-none');
            });
        </script>
    @endpush
</x-app-layout>

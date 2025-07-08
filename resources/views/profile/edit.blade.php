<x-app-layout>
    <x-slot name="header">
        Profile
    </x-slot>

    <div class="container mt-4">
        <h4 class="fw-bold mb-4">Informasi Pribadi</h4>

        <div class="card mb-4">
            <div class="card-body d-flex flex-wrap">
                <div class="me-4 text-center">
                    <img src="{{ asset('default-user.png') }}" width="80" height="80" class="rounded-circle border">
                    <p class="text-danger small mt-2">
                        Anda dapat menambahkan foto <br> anda sendiri bila mau.
                    </p>
                    <button class="btn btn-sm btn-primary">Unggah Foto</button>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between">
                        <strong>Nama lengkap</strong>
                        <a href="#" class="text-primary">Edit Nama</a>
                    </div>
                    <p class="mt-1">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><strong>Informasi Profile</strong></span>
                <a href="#" class="text-primary">Edit Informasi Profil</a>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Nama lengkap:</strong>
                    <p>{{ Auth::user()->name }}</p>
                </div>
                <div class="mb-2">
                    <strong>Email:</strong>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                <div class="mb-2">
                    <strong>Role:</strong>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

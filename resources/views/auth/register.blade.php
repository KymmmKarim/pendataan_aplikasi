<x-guest-layout>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card bg-white shadow rounded-4 p-4 w-100" style="max-width: 550px;">
            
            <!-- Logo di tengah -->
            <div class="text-center mb-3">
                <img src="{{ asset('img/logo-itenas.png') }}" alt="Itenas Logo" style="height: 35px;">
            </div>

            <!-- Judul Register (kiri) -->
            <h4 class="mb-4 fw-bold">Register</h4>

            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" required value="{{ old('username') }}">
                        @error('username') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                        <input type="text" name="unit" id="unit" class="form-control" required value="{{ old('unit') }}">
                        @error('unit') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none" style="color: #004aad;">Already registered?</a>
                    <button type="submit" class="btn" style="background-color: #004aad; color: white;">Register</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>

<x-guest-layout>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> <!-- Custom CSS -->

    <!-- Container tanpa bg-light -->
    <div class="d-flex justify-content-center align-items-center min-vh-100 flex-column">
        
        <!-- Logo Itenas (bebas background) -->
        <div class="mb-4">
            <img src="{{ asset('img/logo-itenas.png') }}" alt="Itenas Logo" style="height: 30px;">
        </div>

        <!-- Card Login dengan background putih -->
        <div class="card bg-light shadow rounded-4 p-4 w-100" style="max-width: 400px;">
            <h4 class="text-center mb-4 fw-bold">Login</h4>

            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control border-bottom-only" required autofocus>
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control border-bottom-only" required>
                    @error('password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                    <label class="form-check-label" for="remember_me">Remember me</label>
                </div>

                <!-- Forgot Password + Button -->
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                    @endif

                    <button type="submit" class="btn btn-primary px-4">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>

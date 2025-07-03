<x-guest-layout>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <div class="d-flex justify-content-center align-items-center min-vh-100 flex-column">
        <!-- Card Reset Password -->
        <div class="card bg-light shadow rounded-4 p-4 w-100" style="max-width: 400px;">
            
            <!-- Logo Itenas di dalam card -->
            <div class="text-center mb-3 mx-auto d-block">
                <img src="{{ asset('img/logo-itenas.png') }}" alt="Itenas Logo" style="height: 35px;">
            </div>

            <!-- Intro Text -->
            <div class="mb-4 text-sm text-secondary">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control border-bottom-only" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn" style="background-color: #004aad; color: white;">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-guest-layout>

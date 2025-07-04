<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Itenas</title>
    <link rel="icon" href="{{ asset('img/logo_itenas.png') }}" type="image/png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>

<!-- Header (logo + topbar) -->
<div class="d-flex header-fixed">
    <!-- Logo kiri -->
    <div class="logo-section d-flex align-items-center px-3 border-end">
        <button class="btn btn-outline-primary me-3" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand d-flex align-items-center m-0" href="#">
            <img src="{{ asset('img/logo-itenas.png') }}" alt="Logo">
        </a>
    </div>

    <!-- Topbar kanan -->
    <div class="flex-grow-1 d-flex justify-content-between align-items-center topbar px-4">
        <span class="fw-bold text-white">Dashboard</span>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Admin 1
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Body -->
<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-white border-end position-fixed h-100" style="top: 64px;">
        <ul class="nav flex-column p-3 pt-4">
            <li class="nav-item mb-1">
                <a class="nav-link active" href="#"><i class="fas fa-home me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link" href="#"><i class="fas fa-globe me-2"></i>Unit 1</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="flex-grow-1 bg-light min-vh-100 p-4">
        {{ $slot }}
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('hidden');
        if (sidebar.classList.contains('hidden')) {
            mainContent.style.marginLeft = '0';
        } else {
            mainContent.style.marginLeft = '250px';
        }
    });

    // Highlight active sidebar
    const links = document.querySelectorAll('#sidebar .nav-link');
    links.forEach(link => {
        link.addEventListener('click', () => {
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });
</script>

@stack('scripts')
</body>
</html>

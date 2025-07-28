<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $header ?? 'Dashboard' }} - Itenas</title>
    <link rel="icon" href="{{ asset('img/logo_itenas.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
<div class="d-flex header-fixed">
    <div class="logo-section d-flex align-items-center justify-content-between px-3 border-end bg-white" style="width: 250px; height: 70px;">
        <button class="btn btn-outline-primary" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand mx-auto" href="dashboard">
            <img src="{{ asset('img/logoitenas.png') }}" alt="Logo" style="height: 45px;">
        </a>
    </div>

    <div class="flex-grow-1 d-flex justify-content-between align-items-center topbar px-4 text-white">
        <span class="fw-bold fs-5">{{ $header ?? 'Dashboard' }}</span>
        <div class="dropdown">
            <button class="btn profile-dropdown d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                {{ Auth::user()->name ?? 'Admin' }}
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" 
                        alt="Foto Profil" 
                        class="rounded-circle object-fit-cover ms-2" 
                        style="width:40px; height:40px;">
                @else
                    <i class="fas fa-user-circle ms-3"></i>
                @endif
            </button>

            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                <li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="button" id="btnLogout">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="d-flex">
    <div id="sidebar" class="bg-white border-end position-fixed h-100" style="width: 250px;">
        <ul class="nav flex-column p-3 pt-4">
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('applications') ? 'active' : '' }}" href="{{ url('applications') }}">
                    <i class="fas fa-globe me-2"></i>Application List
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('units*') ? 'active' : '' }}" href="{{ route('units.index') }}">
                    <i class="fas fa-building me-2"></i>Manajemen Unit
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->is('lokasi_pembelian*') ? 'active' : '' }}" href="{{ route('lokasi_pembelian.index') }}">
                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi Pembelian
                </a>
            </li>

            
            <!-- Manajemen Pengguna Dropdown -->
            <li class="nav-item mb-1">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#userManagementMenu" role="button" aria-expanded="false" aria-controls="userManagementMenu">
                    <div class="d-flex align-items-center">
                        <div class="me-3 d-flex align-items-center justify-content-center" style="width: 30px; height: 40px;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div class="d-flex flex-column lh-sm">
                            <span class="fw">Manajemen</span>
                            <span class="fw">Pengguna</span>
                        </div>
                    </div>
                    <i class="fas fa-chevron-down small ms-2"></i>
                </a>
                <div class="collapse ps-4 {{ request()->is('roles*') || request()->is('users*') ? 'show' : '' }}" id="userManagementMenu">
                    <ul class="nav flex-column mt-2">
                        <li class="nav-item mb-2">
                            <a class="nav-link d-flex align-items-center {{ request()->is('roles*') ? 'active' : '' }}" href="{{ url('roles') }}">
                                <i class="fas fa-user-shield me-2"></i>Hak Akses
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a class="nav-link d-flex align-items-center {{ request()->is('users*') ? 'active' : '' }}" href="{{ url('users') }}">
                                <i class="fas fa-user me-2"></i>Pengguna
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div id="main-content" class="flex-grow-1 bg-light min-vh-100 p-4" style="margin-left: 250px;">
        {{ $slot }}
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('hidden');
        mainContent.style.marginLeft = sidebar.classList.contains('hidden') ? '0' : '250px';
    });

    const links = document.querySelectorAll('#sidebar .nav-link');
    links.forEach(link => {
        link.addEventListener('click', () => {
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });

    // Konfirmasi logout dengan SweetAlert
    const logoutBtn = document.getElementById('btnLogout');
    const logoutForm = document.getElementById('logout-form');

    logoutBtn.addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Kamu akan keluar dari halaman ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                logoutForm.submit();
            }
        });
    });
</script>

@stack('scripts')
</body>
</html>

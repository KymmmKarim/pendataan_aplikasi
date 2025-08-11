<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $header ?? 'Dashboard' }} - Itenas</title>
    <link rel="icon" href="{{ asset('img/logo_itenas.png') }}" type="image/png">

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 250px;
        }

        .logo-section {
            width: var(--sidebar-width);
            background-color: white;
            z-index: 1030;
            height: 70px;
        }

        #sidebar {
            width: var(--sidebar-width);
        }

        #main-content {
    margin-left: var(--sidebar-width);
    transition: margin-left 0.3s ease;
}

.hidden {
        display: none !important;
    }

@media (max-width: 991.98px) {
    #main-content {
        margin-left: 0 !important;
    }

    #sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    #sidebar.show {
        transform: translateX(0);
    }
}

    </style>
</head>
<body>
<div class="d-flex header-fixed">

    {{-- TOPBAR DESKTOP --}}
    <div class="topbar-desktop d-flex w-100">
        <div class="logo-section d-flex align-items-center justify-content-between px-3 border-end">
            <button class="btn btn-outline-primary" id="toggleSidebarDesktop">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand mx-auto" href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logoitenas.png') }}" alt="Logo" style="height: 45px;">
            </a>
        </div>

        <div class="flex-grow-1 d-flex justify-content-between align-items-center topbar px-4 text-white">
            <span class="fw-bold fs-5">{{ $header ?? 'Dashboard' }}</span>
            <div class="dropdown">
                <button class="btn profile-dropdown d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name ?? 'Admin' }}
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle object-fit-cover ms-2" style="width:40px; height:40px;">
                    @else
                        <i class="fas fa-user-circle ms-3"></i>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
                    <li>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger py-2" type="button" id="btnLogout">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- TOPBAR MOBILE --}}
    <div class="topbar-mobile w-100">
        <button class="btn-toggle-sidebar" id="toggleSidebarMobile">
            <i class="fas fa-bars"></i><span class="fw-bold fs-5" style="margin-left:8px; margin-right:8px; line-height:1.5;">
    {{ $header ?? 'Dashboard' }}
</span>

          
        </button>
        <div class="dropdown">
    <button class="btn profile-dropdown d-flex align-items-center" type="button" data-bs-toggle="dropdown">
        @if(Auth::user()->photo)
            <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle object-fit-cover" style="width:40px; height:40px;">
        @else
            <i class="fas fa-user-circle" style="font-size: 28px;"></i>
        @endif
    </button>

    <ul class="dropdown-menu dropdown-menu-end p-2 shadow-lg" style="min-width: 250px;">
        <!-- Header profil -->
        <li class="px-3 py-2 text-center border-bottom">
            @if(Auth::user()->photo)
                <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="rounded-circle object-fit-cover mb-2" style="width:60px; height:60px;">
            @else
                <i class="fas fa-user-circle mb-2" style="font-size: 60px; color: #ccc;"></i>
            @endif
            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
            <small class="text-muted">{{ Auth::user()->email }}</small>
        </li>

        <!-- Menu -->
        <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Profil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item text-danger py-2" type="button" id="btnLogout">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

    </div>

</div>


<div class="d-flex">
    <div id="sidebar" class="bg-white border-end position-fixed h-100">
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

            @if(!Auth::user()->hasRole('admin-unit'))
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

                <li class="nav-item mb-1">
    <div class="nav-link d-flex justify-content-between align-items-center menu-toggle" role="button" data-bs-toggle="collapse" data-bs-target="#userManagementMenu" aria-expanded="false">
        <div class="d-flex align-items-center">
            <i class="fas fa-users fa-lg me-2"></i>
            <div class="d-flex flex-column lh-sm">
                <span class="fw">Manajemen</span>
                <span class="fw">Pengguna</span>
            </div>
        </div>
        <i class="fas fa-chevron-down small ms-2"></i>
    </div>
    <div class="collapse ps-4 {{ request()->is('roles*') || request()->is('users*') ? 'show' : '' }}" id="userManagementMenu">
        <ul class="nav flex-column mt-2">
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" href="{{ url('roles') }}">
                    <i class="fas fa-user-shield me-2"></i>Hak Akses
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ url('users') }}">
                    <i class="fas fa-user me-2"></i>Pengguna
                </a>
            </li>
        </ul>
    </div>
</li>

                        </ul>
                    </div>
                </li>
            @endif
        </ul>
    </div>

    <div id="main-content" class="flex-grow-1 bg-light min-vh-100 p-4">
        {{ $slot }}
    </div>F
</div>

<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Sidebar Toggle and Logout -->
<script>
    const toggleBtnDesktop = document.getElementById('toggleSidebarDesktop');
    const toggleBtnMobile = document.getElementById('toggleSidebarMobile');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    function toggleSidebar() {
        if (window.innerWidth <= 991.98) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('hidden');
            mainContent.style.marginLeft = sidebar.classList.contains('hidden')
                ? '0'
                : getComputedStyle(document.documentElement).getPropertyValue('--sidebar-width');
        }
    }

    // Event listener untuk desktop dan mobile
    toggleBtnDesktop.addEventListener('click', toggleSidebar);
    toggleBtnMobile.addEventListener('click', toggleSidebar);

    // Tutup sidebar saat klik link di mobile
    if (window.innerWidth <= 991.98) {
        const sidebarLinks = document.querySelectorAll('.menu-toggle').forEach(el => {
    el.addEventListener('click', function(e) {
        e.preventDefault();      // cegah link
        e.stopPropagation();     // cegah trigger close sidebar
    });
});

    }

    // Highlight link aktif
    const links = document.querySelectorAll('#sidebar .nav-link');
    links.forEach(link => {
        link.addEventListener('click', () => {
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
        });
    });

    // Konfirmasi logout
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

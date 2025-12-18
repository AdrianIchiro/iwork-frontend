<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #fafafa;
            font-family: 'Inter', sans-serif;
        }

        .table-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-scroll table {
            min-width: 700px;
            /* supaya scroll muncul di mobile */
        }

        /* Optional: scrollbar lebih halus */
        .table-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        /* LOGO GENERAL */
        .logo-desktop,
        .logo-mobile,
        .logo-offcanvas {
            object-fit: contain;
        }

        /* SIDEBAR DESKTOP */
        .logo-desktop {
            width: 120px;
            height: auto;
            margin-bottom: 30px;
        }

        /* NAVBAR MOBILE */
        .logo-mobile {
            height: 32px;
            width: auto;
        }

        /* OFFCANVAS MOBILE */
        .logo-offcanvas {
            height: 36px;
            width: auto;
        }



        /* SIDEBAR DESKTOP */
        .sidebar {
            height: 100vh;
            width: 240px;
            position: fixed;
            top: 0;
            left: 0;
            background: #ffffff;
            border-right: 1px solid #e5e5e5;
            padding: 25px 20px;
        }

        .sidebar h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
        }

        .menu-item {
            padding: 12px 15px;
            border-radius: 10px;
            color: #333;
            cursor: pointer;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            font-weight: 500;
        }

        .menu-item i {
            font-size: 16px;
            color: #888;
        }

        .menu-item:hover {
            background: #f0f4ff;
            color: #2c60ff;
        }

        .menu-active {
            background: #e8efff;
            color: #2c60ff !important;
            font-weight: 600;
        }

        .menu-active i {
            color: #2c60ff !important;
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            padding: 35px;
            transition: 0.3s;
        }

        .card-custom {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        /* NAVBAR MOBILE */
        .mobile-nav {
            display: none;
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #e5e5e5;
        }

        .mobile-nav button {
            font-size: 22px;
        }

        /* RESPONSIVE BEHAVIOR */
        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0 !important;
            }

            .mobile-nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }
    </style>

    @stack('styles')
</head>

<body>


    <!-- NAVBAR MOBILE -->
    <div class="mobile-nav">
        <button class="btn" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas">
            <i class="fa-solid fa-bars"></i>
        </button>
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-mobile">
    </div>

    <!-- SIDEBAR DESKTOP -->
    <div class="sidebar d-none d-lg-block">
        <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo-desktop">

        <a href="{{ route('employer.index') }}"
            class="menu-item {{ request()->routeIs('employer.index') ? 'menu-active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>

        <a href="{{ route('employer.quest') }}"
            class="menu-item {{ request()->routeIs('employer.quest') ? 'menu-active' : '' }}">
            <i class="fa-solid fa-plus"></i> Tambah Quest
        </a>

        <a href="{{ route('employer.job') }}"
            class="menu-item {{ request()->routeIs('employer.job') ? 'menu-active' : '' }}">
            <i class="fa-solid fa-briefcase"></i> Tambah Job
        </a>

        <a href="{{ route('employer.submissions') }}"
            class="menu-item {{ request()->routeIs('employer.submissions') ? 'menu-active' : '' }}">
            <i class="fa-solid fa-clipboard-check"></i> Submissions
        </a>

        <a href="{{ route('employer.manage-plan') }}"
            class="menu-item {{ request()->routeIs('employer.manage-plan') ? 'menu-active' : '' }}">
            <i class="fa-solid fa-crown"></i> Manage Plan
        </a>

        <a href="{{ route('logout') }}" class="menu-item">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

    <!-- SIDEBAR MOBILE (Offcanvas) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas">
        <div class="offcanvas-header">
            <img src="{{ asset('images/logo.png') }}" alt="">
            <button class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body">

            <a href="{{ route('employer.index') }}"
                class="menu-item {{ request()->routeIs('employer.index') ? 'menu-active' : '' }}">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>

            <a href="{{ route('employer.quest') }}"
                class="menu-item {{ request()->routeIs('employer.quest') ? 'menu-active' : '' }}">
                <i class="fa-solid fa-plus"></i> Tambah Quest
            </a>

            <a href="{{ route('employer.job') }}"
                class="menu-item {{ request()->routeIs('employer.job') ? 'menu-active' : '' }}">
                <i class="fa-solid fa-briefcase"></i> Tambah Job
            </a>

            <a href="{{ route('employer.submissions') }}"
                class="menu-item {{ request()->routeIs('employer.submissions') ? 'menu-active' : '' }}">
                <i class="fa-solid fa-clipboard-check"></i> Submissions
            </a>

            <a href="{{ route('employer.manage-plan') }}"
                class="menu-item {{ request()->routeIs('employer.manage-plan') ? 'menu-active' : '' }}">
                <i class="fa-solid fa-crown"></i> Manage Plan
            </a>

            <a href="{{ route('logout') }}" class="menu-item">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h3 class="fw-bold mb-4">Employer Dashboard</h3>
        @yield('content')
    </div>

    @stack('scripts')

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        let map = null;
        let marker = null;

        const modal = document.getElementById('modalTambahJob');

        modal.addEventListener('shown.bs.modal', function () {

            // Jika map sudah pernah dibuat
            if (map) {
                setTimeout(() => {
                    map.invalidateSize();
                }, 200);
                return;
            }

            // Default Indonesia
            const defaultLat = -6.200000;
            const defaultLng = 106.816666;

            map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            marker = L.marker([defaultLat, defaultLng]).addTo(map);

            // Set default input
            document.getElementById('latitude').value = defaultLat;
            document.getElementById('longitude').value = defaultLng;

            // Klik peta
            map.on('click', function (e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);

                marker.setLatLng(e.latlng);

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
            });

            // SEARCH
            L.Control.geocoder({
                defaultMarkGeocode: false
            })
                .on('markgeocode', function (e) {
                    const latlng = e.geocode.center;
                    map.setView(latlng, 16);
                    marker.setLatLng(latlng);

                    document.getElementById('latitude').value = latlng.lat.toFixed(6);
                    document.getElementById('longitude').value = latlng.lng.toFixed(6);
                })
                .addTo(map);

            // GPS AUTO
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (pos) {
                        const lat = pos.coords.latitude;
                        const lng = pos.coords.longitude;
                        map.setView([lat, lng], 15);
                        marker.setLatLng([lat, lng]);

                        document.getElementById('latitude').value = lat.toFixed(6);
                        document.getElementById('longitude').value = lng.toFixed(6);
                    }
                );
            }

            // Paksa refresh size
            setTimeout(() => {
                map.invalidateSize();
            }, 300);
        });

    });
</script>

</html>
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

</html>

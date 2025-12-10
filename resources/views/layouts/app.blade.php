<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'IWORK' }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Global Styles --}}
    <style>
        body {
            background: #f5f5f5;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .main-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
    </style>

    {{-- Page-specific CSS --}}
    @stack('styles')
</head>

<body>

    <div class="main-container">
        {{-- Main Content --}}
        <main class="flex-fill">
            {{-- NAVBAR --}}
            <nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm">
                <div class="container">

                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('images/logo.png') }}" alt="logo" width="100px">
                    </a>

                    <!-- TOGGLER -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars fs-3"></i> <!-- FA icon biar kelihatan -->
                    </button>

                    <!-- COLLAPSE -->
                    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">

                        <ul class="navbar-nav gap-4 mt-3 mt-lg-0 text-center">
                            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Quest</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        </ul>

                        <!-- PROFILE MOBILE -->
                        <div class="d-lg-none mt-3 text-center">
                            <div class="mb-2">
                                <span class="me-2">{{ $user['name'] }}</span>
                                <i class="fa-solid fa-circle-user fs-4"></i>
                            </div>
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger">Logout</a>
                        </div>
                    </div>

                    <!-- PROFILE DESKTOP -->
                    <div class="d-none d-lg-flex align-items-center gap-2 ms-3 dropdown">
                        <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ $user['name'] }}</span>
                            <i class="fa-solid fa-circle-user fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>

                </div>
            </nav>
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Page-specific Scripts --}}
    @stack('scripts')

</body>

</html>
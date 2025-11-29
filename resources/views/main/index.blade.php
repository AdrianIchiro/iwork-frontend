@extends('layouts.app')

@section('content')
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm">
        <div class="container">

            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="logo" width="100px">
            </a>

            <!-- TOGGLER -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <span class="me-2">Adrian</span>
                    <i class="fa-solid fa-circle-user fs-4"></i>
                </div>
            </div>

            <!-- PROFILE DESKTOP -->
            <div class="d-none d-lg-flex align-items-center gap-2 ms-3">
                <span>Adrian</span>
                <i class="fa-solid fa-circle-user fs-4"></i>
            </div>

        </div>
    </nav>

    <!-- SEARCH BAR -->
    <div class="container search-container">
        <div class="position-relative">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
            <input type="text" class="form-control search-box search-custom" placeholder="Search">
        </div>
    </div>

    <!-- JOB CARD GRID -->
    <div class="container mt-5">
        <div class="row g-4 justify-content-center">

            <!-- CARD 1 -->
            <div class="col-md-3">
                <div class="job-card">
                    <h6>Jaga Kebun</h6>
                    <span class="level-badge entry">Entry Level</span>

                    <p class="mt-3 mb-1" style="font-size: 14px;">
                        Menjaga kebun di perumahan bogor untuk selama 5 hari dan merawatnya.
                    </p>

                    <small class="text-muted">Deadline: 15 Februari 2026</small>

                    <button class="btn btn-outline-info mt-3 btn-bid">Bid</button>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="col-md-3">
                <div class="job-card">
                    <h6>Rawat Musang</h6>
                    <span class="level-badge mid">Mid Level</span>

                    <p class="mt-3 mb-1" style="font-size: 14px;">
                        Merawat musang di perumahan bogor untuk selama 5 hari dan merawatnya.
                    </p>

                    <small class="text-muted">Deadline: 15 Februari 2026</small>

                    <button class="btn btn-outline-info mt-3 btn-bid">Bid</button>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-md-3">
                <div class="job-card">
                    <h6>Jaga Kebun</h6>
                    <span class="level-badge entry">Entry Level</span>

                    <p class="mt-3 mb-1" style="font-size: 14px;">
                        Menjaga kebun di perumahan bogor untuk selama 5 hari dan merawatnya.
                    </p>

                    <small class="text-muted">Deadline: 15 Februari 2026</small>

                    <button class="btn btn-outline-info mt-3 btn-bid">Bid</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* NAVBAR */
        .navbar-brand {
            font-weight: 700;
            font-size: 22px;
        }

        /* SEARCH BAR */
        .search-container {
            margin-top: 40px;
        }

        .search-box {
            border-radius: 50px;
            padding-left: 50px;
            height: 55px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #6c757d;
        }

        /* CARD JOB */
        .job-card {
            border-radius: 10px;
            border: 1px solid #dfdfdf;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: 0.2s;
        }

        .job-card:hover {
            transform: translateY(-3px);
        }

        .level-badge {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 7px;
            color: #fff;
        }

        .entry {
            background-color: #00bfff2f;
            color: #00BFFF;
        }

        .mid {
            background-color: #ffe1002d;
            color: #FFE100;
        }

        .high {
            background-color: #ef4444;
        }

        .btn-bid {
            border-radius: 20px;
            width: 100%;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 0.7)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
@endpush

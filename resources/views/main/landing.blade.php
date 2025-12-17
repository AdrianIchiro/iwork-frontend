@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row align-items-center g-4">

                <!-- LEFT -->
                <div class="col-md-6 text-center text-md-start">
                    <h1 class="fw-bold mb-3">
                        Temukan Quest. <br>
                        Dapatkan Penghasilan.
                    </h1>

                    <p class="text-muted mb-4">
                        IWORK menghubungkan talent dengan employer melalui quest singkat,
                        jelas, dan fleksibel. Kerjakan sesuai kemampuanmu, dapatkan reward nyata.
                    </p>

                    <div class="d-flex gap-3 justify-content-center justify-content-md-start">
                        <a href="{{ route('main.quest') }}" class="btn btn-primary px-4">
                            Jelajahi Quest
                        </a>
                        <a href="#" class="btn btn-outline-secondary px-4">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/hero.png') }}" alt="hero" class="img-fluid" style="max-height: 400px;">
                </div>

            </div>
        </div>
    </section>

    <!-- STATS -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center g-4">

                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <h3 class="fw-bold text-primary mb-1">100+</h3>
                        <p class="text-muted mb-0">Quest Aktif</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <h3 class="fw-bold text-success mb-1">50+</h3>
                        <p class="text-muted mb-0">Employer Terdaftar</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                        <h3 class="fw-bold text-warning mb-1">1K+</h3>
                        <p class="text-muted mb-0">Talent Bergabung</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FEATURE -->
    <section class="py-5 bg-white">
        <div class="container">

            <div class="text-center mb-5">
                <h4 class="fw-semibold">Kenapa IWORK?</h4>
                <p class="text-muted">
                    Platform kerja fleksibel yang dirancang untuk semua level
                </p>
            </div>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="p-4 rounded-4 shadow-sm h-100">
                        <i class="fa-solid fa-bolt fs-2 text-primary mb-3"></i>
                        <h6 class="fw-semibold">Quest Singkat</h6>
                        <p class="text-muted mb-0">
                            Tugas jelas, durasi singkat, tanpa birokrasi rumit.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 shadow-sm h-100">
                        <i class="fa-solid fa-ranking-star fs-2 text-warning mb-3"></i>
                        <h6 class="fw-semibold">Tier Transparan</h6>
                        <p class="text-muted mb-0">
                            Entry, Mid, hingga High. Pilih sesuai skill kamu.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 rounded-4 shadow-sm h-100">
                        <i class="fa-solid fa-wallet fs-2 text-success mb-3"></i>
                        <h6 class="fw-semibold">Reward Jelas</h6>
                        <p class="text-muted mb-0">
                            Tidak ada kerja gratis. Semua quest punya nilai.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5">
        <div class="container">
            <div class="bg-primary text-white rounded-4 p-5 text-center">

                <h4 class="fw-semibold mb-3">
                    Siap mulai quest pertamamu?
                </h4>

                <p class="mb-4">
                    Jelajahi ratusan quest dari employer terpercaya sekarang juga.
                </p>

                <a href="{{ route('main.quest') }}" class="btn btn-light px-4 fw-semibold">
                    Mulai Sekarang
                </a>

            </div>
        </div>
    </section>
@endsection

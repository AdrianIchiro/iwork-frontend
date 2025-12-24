@extends('layouts.app')

@section('content')
    {{-- Mission Section --}}
    <section class="about-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="content-card">
                        <p class="lead text-center mb-4">
                            I Work adalah platform inovatif yang menghubungkan pencari kerja dengan pemberi kerja
                            melalui sistem <strong>Quest-based freelancing</strong>.
                        </p>

                        <div class="mission-points">
                            <div class="mission-item">

                                <div class="mission-text">
                                    <h5>Konsep Inovatif</h5>
                                    <p>Berbeda dari platform freelance tradisional, I Work menggunakan sistem "Quest"
                                        yang memungkinkan pekerja memilih tugas-tugas kecil sesuai kemampuan dan waktu
                                        mereka.</p>
                                </div>
                            </div>

                            <div class="mission-item">

                                <div class="mission-text">
                                    <h5>Membangun Portfolio</h5>
                                    <p>Setiap quest yang berhasil diselesaikan akan otomatis tercatat dalam portfolio
                                        digital,
                                        membantu pekerja membangun rekam jejak profesional mereka.</p>
                                </div>
                            </div>

                            <div class="mission-item">

                                <div class="mission-text">
                                    <h5>Win-Win Solution</h5>
                                    <p>Pemberi kerja mendapatkan akses ke talenta berkualitas dengan fleksibilitas tinggi,
                                        sementara pekerja mendapatkan kesempatan untuk mengembangkan skill dan mendapatkan
                                        penghasilan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="vision-box mt-4">
                            <h5>Visi Kami</h5>
                            <p class="mb-0">Menjadi platform terdepan dalam memberdayakan pekerja Indonesia
                                melalui kesempatan kerja yang fleksibel dan bermakna.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section class="team-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">
                Meet The Team
            </h2>

            <div class="row justify-content-center g-4">
                {{-- Kevin --}}
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="{{ asset('images/kevin.png') }}" alt="Kevin">
                        </div>
                        <div class="team-info">
                            <h4>Kevin</h4>

                            <blockquote class="team-quote">
                                <i class="fa-solid fa-quote-left"></i>
                                Hogwarts is my Legacy
                                <i class="fa-solid fa-quote-right"></i>
                            </blockquote>
                        </div>
                    </div>
                </div>

                {{-- Adrian --}}
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="{{ asset('images/adrian.png') }}" alt="Adrian">
                        </div>
                        <div class="team-info">
                            <h4>Adrian</h4>

                            <blockquote class="team-quote">
                                <i class="fa-solid fa-quote-left"></i>
                                Slow Living Motherfucker
                                <i class="fa-solid fa-quote-right"></i>
                            </blockquote>
                        </div>
                    </div>
                </div>

                {{-- Farhan --}}
                <div class="col-md-4">
                    <div class="team-card">
                        <div class="team-photo">
                            <img src="{{ asset('images/farhan.png') }}" alt="Farhan">
                        </div>
                        <div class="team-info">
                            <h4>Farhan</h4>

                            <blockquote class="team-quote">
                                <i class="fa-solid fa-quote-left"></i>
                                Woy Kuda
                                <i class="fa-solid fa-quote-right"></i>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .text-gradient {
            background: linear-gradient(90deg, #ffd700, #ffaa00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }



        /* Content Card */
        .content-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-weight: 700;
            color: #333;
        }

        /* Mission Items */
        .mission-item {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .mission-item:last-child {
            border-bottom: none;
        }

        .mission-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            flex-shrink: 0;
        }

        .mission-text h5 {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .mission-text p {
            color: #666;
            margin-bottom: 0;
            line-height: 1.7;
        }

        /* Vision Box */
        .vision-box {
            background: linear-gradient(135deg, #f8f9ff, #f0f4ff);
            border-left: 4px solid #667eea;
            padding: 20px 25px;
            border-radius: 0 12px 12px 0;
        }

        .vision-box h5 {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .vision-box p {
            color: #555;
        }

        /* Team Section */
        .team-section {
            background: #f8f9fa;
        }

        .team-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
        }


        .team-photo {
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .team-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .team-info {
            padding: 25px;
        }

        .team-info h4 {
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .team-info .role {
            color: #667eea;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .team-quote {
            font-style: italic;
            color: #666;
            font-size: 0.95rem;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            margin: 0;
        }

        .team-quote .fa-quote-left,
        .team-quote .fa-quote-right {
            color: #667eea;
            font-size: 0.8rem;
            opacity: 0.6;
        }

        .team-quote .fa-quote-left {
            margin-right: 5px;
        }

        .team-quote .fa-quote-right {
            margin-left: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .content-card {
                padding: 25px;
            }

            .mission-item {
                flex-direction: column;
                text-align: center;
            }

            .mission-icon {
                margin: 0 auto;
            }
        }
    </style>
@endpush
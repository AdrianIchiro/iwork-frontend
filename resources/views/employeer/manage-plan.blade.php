@extends('layouts.employe')

@section('content')
    <div class="mb-4">
        <h4 class="fw-bold">Manage Plan</h4>
        <p class="text-muted">Pilih paket langganan yang sesuai dengan kebutuhan Anda</p>
    </div>

    <div class="row g-4">
        <!-- ENTRY TIER -->
        <div class="col-md-4">
            <div class="card-custom plan-card">
                <div class="plan-header entry-bg">
                    <h5 class="mb-0">Entry</h5>
                    <span class="plan-badge">Pemula</span>
                </div>
                <div class="plan-body">
                    <div class="plan-price">
                        <span class="currency">Rp</span>
                        <span class="amount">99.000</span>
                        <span class="period">/bulan</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-check"></i> 5 Quest per minggu</li>
                        <li><i class="fa-solid fa-check"></i> Basic support</li>
                        <li><i class="fa-solid fa-check"></i> Dashboard analytics</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Priority listing</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Featured badge</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary w-100">Pilih Plan</a>
                </div>
            </div>
        </div>

        <!-- MID TIER -->
        <div class="col-md-4">
            <div class="card-custom plan-card popular">
                <div class="popular-badge">Popular</div>
                <div class="plan-header mid-bg">
                    <h5 class="mb-0">Mid</h5>
                    <span class="plan-badge">Profesional</span>
                </div>
                <div class="plan-body">
                    <div class="plan-price">
                        <span class="currency">Rp</span>
                        <span class="amount">249.000</span>
                        <span class="period">/bulan</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-check"></i> 15 Quest per minggu</li>
                        <li><i class="fa-solid fa-check"></i> Priority support</li>
                        <li><i class="fa-solid fa-check"></i> Advanced analytics</li>
                        <li><i class="fa-solid fa-check"></i> Priority listing</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Featured badge</li>
                    </ul>
                    <a href="#" class="btn btn-primary w-100">Pilih Plan</a>
                </div>
            </div>
        </div>

        <!-- HIGH TIER -->
        <div class="col-md-4">
            <div class="card-custom plan-card">
                <div class="plan-header high-bg">
                    <h5 class="mb-0">High</h5>
                    <span class="plan-badge">Enterprise</span>
                </div>
                <div class="plan-body">
                    <div class="plan-price">
                        <span class="currency">Rp</span>
                        <span class="amount">499.000</span>
                        <span class="period">/bulan</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-check"></i> Unlimited Quest</li>
                        <li><i class="fa-solid fa-check"></i> 24/7 Dedicated support</li>
                        <li><i class="fa-solid fa-check"></i> Full analytics suite</li>
                        <li><i class="fa-solid fa-check"></i> Priority listing</li>
                        <li><i class="fa-solid fa-check"></i> Featured badge</li>
                    </ul>
                    <a href="#" class="btn btn-outline-danger w-100">Pilih Plan</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .plan-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .plan-card.popular {
            border: 2px solid #ffc107;
        }

        .popular-badge {
            position: absolute;
            top: 10px;
            right: -30px;
            background: #ffc107;
            color: #000;
            padding: 5px 40px;
            font-size: 12px;
            font-weight: 600;
            transform: rotate(45deg);
        }

        .plan-header {
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .plan-header h5 {
            font-weight: 700;
        }

        .plan-badge {
            font-size: 12px;
            opacity: 0.9;
        }

        .entry-bg {
            background: linear-gradient(135deg, #00BFFF, #0099cc);
        }

        .mid-bg {
            background: linear-gradient(135deg, #FFD700, #FFA500);
        }

        .high-bg {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .plan-body {
            padding: 25px;
        }

        .plan-price {
            text-align: center;
            margin-bottom: 20px;
        }

        .plan-price .currency {
            font-size: 16px;
            vertical-align: top;
        }

        .plan-price .amount {
            font-size: 36px;
            font-weight: 700;
        }

        .plan-price .period {
            font-size: 14px;
            color: #666;
        }

        .plan-features {
            list-style: none;
            padding: 0;
            margin-bottom: 25px;
        }

        .plan-features li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .plan-features li:last-child {
            border-bottom: none;
        }

        .plan-features li i {
            margin-right: 10px;
            width: 16px;
        }

        .plan-features li .fa-check {
            color: #22c55e;
        }

        .plan-features li .fa-xmark {
            color: #ef4444;
        }

        .plan-features li.disabled {
            color: #999;
        }
    </style>
@endpush
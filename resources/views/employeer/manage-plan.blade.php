@extends('layouts.employe')

@section('content')
    <div class="mb-4">
        <h4 class="fw-bold">Manage Plan</h4>
        <p class="text-muted">Pilih paket langganan yang sesuai dengan kebutuhan Anda</p>
    </div>

    {{-- Alert Messages --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Subscription Plans Section --}}
    <div class="section-title mb-3">
        <h5><i class="fa-solid fa-crown me-2"></i>Paket Langganan Mingguan</h5>
        <p class="text-muted small mb-0">Kuota direset setiap minggu selama masa langganan aktif</p>
    </div>

    <div class="row g-4 mb-5">
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
                        <span class="amount">100.000</span>
                        <span class="period">/bulan</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-check"></i> 5 Quest per minggu</li>
                        <li><i class="fa-solid fa-check"></i> Basic support</li>
                        <li><i class="fa-solid fa-check"></i> Dashboard analytics</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Priority listing</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Featured badge</li>
                    </ul>
                    <form action="{{ route('employer.subscription.buy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tier" value="ENTRY">
                        <button type="submit" class="btn btn-outline-primary w-100">
                            <i class="fa-solid fa-shopping-cart me-2"></i>Pilih Plan
                        </button>
                    </form>
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
                        <span class="amount">250.000</span>
                        <span class="period">/bulan</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-check"></i> 20 Quest per minggu</li>
                        <li><i class="fa-solid fa-check"></i> Priority support</li>
                        <li><i class="fa-solid fa-check"></i> Advanced analytics</li>
                        <li><i class="fa-solid fa-check"></i> Priority listing</li>
                        <li class="disabled"><i class="fa-solid fa-xmark"></i> Featured badge</li>
                    </ul>
                    <form action="{{ route('employer.subscription.buy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tier" value="MID">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-shopping-cart me-2"></i>Pilih Plan
                        </button>
                    </form>
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
                        <span class="amount">750.000</span>
                        <span class="period">/bulan</span>
                    </div>
                    <ul class="plan-features">
                        <li><i class="fa-solid fa-check"></i> 100 Quest per minggu</li>
                        <li><i class="fa-solid fa-check"></i> 24/7 Dedicated support</li>
                        <li><i class="fa-solid fa-check"></i> Full analytics suite</li>
                        <li><i class="fa-solid fa-check"></i> Priority listing</li>
                        <li><i class="fa-solid fa-check"></i> Featured badge</li>
                    </ul>
                    <form action="{{ route('employer.subscription.buy') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tier" value="HIGH">
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fa-solid fa-rocket me-2"></i>Pilih Plan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- One-Time Quota Section --}}
    <div class="section-title mb-3">
        <h5><i class="fa-solid fa-bolt me-2"></i>Beli Kuota Satuan</h5>
        <p class="text-muted small mb-0">Beli kuota tambahan tanpa berlangganan</p>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="quota-card">
                <div class="quota-accent"></div>
                <div class="quota-content">
                    <div class="quota-header">
                        <div class="quota-icon">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div class="quota-info">
                            <h5 class="mb-1">Kuota Quest Satuan</h5>
                            <p class="text-muted mb-0">Fleksibel, bayar sesuai kebutuhan</p>
                        </div>
                    </div>

                    <div class="quota-price-tag">
                        <span class="price-label">Harga per kuota:</span>
                        <span class="price-value">Rp 15.000</span>
                    </div>

                    <form action="{{ route('employer.quota.buy') }}" method="POST" id="quotaForm">
                        @csrf
                        <div class="quota-input-group">
                            <label for="quantity" class="form-label">Jumlah Kuota</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary" id="decreaseQty">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <input type="number" name="quantity" id="quantity" class="form-control text-center"
                                    value="1" min="1" max="100" required>
                                <button type="button" class="btn btn-outline-secondary" id="increaseQty">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="quota-total">
                            <div class="total-row">
                                <span>Jumlah:</span>
                                <span id="displayQuantity">1</span> kuota
                            </div>
                            <div class="total-row total-price">
                                <span>Total:</span>
                                <span id="totalPrice">Rp 15.000</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-quota w-100">
                            <i class="fa-solid fa-credit-card me-2"></i>Beli Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Section Titles */
        .section-title h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        /* Subscription Plan Cards */
        .plan-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
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
            background: linear-gradient(135deg, #ffc107, #ff9800);
            color: #000;
            padding: 5px 40px;
            font-size: 12px;
            font-weight: 600;
            transform: rotate(45deg);
            z-index: 10;
        }

        .plan-header {
            padding: 25px 20px;
            color: #fff;
            text-align: center;
        }

        .plan-header h5 {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .plan-badge {
            font-size: 12px;
            opacity: 0.9;
            background: rgba(255, 255, 255, 0.2);
            padding: 3px 12px;
            border-radius: 20px;
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
            color: #666;
        }

        .plan-price .amount {
            font-size: 36px;
            font-weight: 700;
            color: #333;
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
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
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

        /* One-Time Quota Card - Distinct Style */
        .quota-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .quota-accent {
            height: 6px;
            background: linear-gradient(90deg, #10b981, #34d399, #6ee7b7);
        }

        .quota-content {
            padding: 25px;
        }

        .quota-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .quota-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #10b981, #34d399);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 24px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .quota-info h5 {
            font-weight: 700;
            color: #333;
        }

        .quota-price-tag {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .price-label {
            color: #166534;
            font-weight: 500;
        }

        .price-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #15803d;
        }

        .quota-input-group {
            margin-bottom: 20px;
        }

        .quota-input-group .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .quota-input-group .input-group {
            max-width: 200px;
        }

        .quota-input-group .form-control {
            font-size: 1.25rem;
            font-weight: 600;
            border-left: none;
            border-right: none;
        }

        .quota-input-group .btn {
            width: 45px;
        }

        .quota-total {
            background: #f9fafb;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            color: #666;
        }

        .total-row.total-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #333;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
            margin-top: 5px;
        }

        .btn-quota {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            color: #fff;
            padding: 14px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-quota:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            color: #fff;
        }

        /* Info Card */
        .quota-info-card {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border: 1px solid #bae6fd;
            border-radius: 16px;
            padding: 25px;
            height: 100%;
        }

        .quota-info-card h6 {
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 15px;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .info-list li {
            padding: 10px 0;
            color: #0c4a6e;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-list li i {
            color: #0ea5e9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .quota-input-group .input-group {
                max-width: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInput = document.getElementById('quantity');
            const decreaseBtn = document.getElementById('decreaseQty');
            const increaseBtn = document.getElementById('increaseQty');
            const displayQuantity = document.getElementById('displayQuantity');
            const totalPrice = document.getElementById('totalPrice');
            const pricePerQuota = 15000;

            function formatRupiah(number) {
                return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function updateTotal() {
                let qty = parseInt(quantityInput.value) || 1;
                if (qty < 1) qty = 1;
                if (qty > 100) qty = 100;
                quantityInput.value = qty;
                displayQuantity.textContent = qty;
                totalPrice.textContent = formatRupiah(qty * pricePerQuota);
            }

            decreaseBtn.addEventListener('click', function () {
                let current = parseInt(quantityInput.value) || 1;
                if (current > 1) {
                    quantityInput.value = current - 1;
                    updateTotal();
                }
            });

            increaseBtn.addEventListener('click', function () {
                let current = parseInt(quantityInput.value) || 1;
                if (current < 100) {
                    quantityInput.value = current + 1;
                    updateTotal();
                }
            });

            quantityInput.addEventListener('input', updateTotal);
            quantityInput.addEventListener('change', updateTotal);
        });
    </script>
@endpush
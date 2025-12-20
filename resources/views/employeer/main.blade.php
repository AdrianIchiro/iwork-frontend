@extends('layouts.employe')

@section('content')
    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card-custom">
                <h6 class="text-muted mb-1">Total Quest Dibuat</h6>
                <h2 class="fw-bold">{{ $questCount }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom">
                <h6 class="text-muted mb-1">Total Submission</h6>
                <h2 class="fw-bold">{{ $totalSubmissions }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom">
                <h6 class="text-muted mb-1">Sisa One-Time Quota</h6>
                <h2 class="fw-bold">{{ $onetimeQuota }}</h2>
            </div>
        </div>

    </div>

    {{-- SUBSCRIPTION STATUS PANEL --}}
    <div class="row mb-4">
        <div class="col-md-4">
            @if($subscription)
                @php
                    $tierColors = [
                        'ENTRY' => ['bg' => 'linear-gradient(135deg, #00BFFF, #0099cc)', 'badge' => '#0099cc'],
                        'MID' => ['bg' => 'linear-gradient(135deg, #FFD700, #FFA500)', 'badge' => '#FFA500'],
                        'HIGH' => ['bg' => 'linear-gradient(135deg, #ef4444, #dc2626)', 'badge' => '#dc2626'],
                    ];
                    $colors = $tierColors[$subscription['tier']] ?? ['bg' => 'linear-gradient(135deg, #6b7280, #4b5563)', 'badge' => '#6b7280'];
                    $expiresAt = \Carbon\Carbon::parse($subscription['renewsAt']);
                    $resetAt = $subscription['resetAt'] ? \Carbon\Carbon::parse($subscription['resetAt']) : null;
                @endphp
                <div class="subscription-panel" style="background: {{ $colors['bg'] }};">
                    <div class="subscription-content">
                        <div class="subscription-header">
                            <div class="subscription-badge" style="background: {{ $colors['badge'] }};">
                                <i class="fa-solid fa-crown"></i> {{ $subscription['tier'] }} TIER
                            </div>
                            <span class="subscription-status active">
                                <i class="fa-solid fa-circle"></i> Aktif
                            </span>
                        </div>

                        <div class="subscription-details">
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                                <div class="detail-info">
                                    <span class="detail-label">Kuota Mingguan</span>
                                    <span class="detail-value">{{ $subscription['remaining'] }} /
                                        {{ $subscription['weeklyQuota'] }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-sync"></i>
                                </div>
                                <div class="detail-info">
                                    <span class="detail-label">Reset Kuota</span>
                                    <span class="detail-value">{{ $resetAt ? $resetAt->format('d M Y') : '-' }}</span>
                                </div>
                            </div>

                            <div class="detail-item">
                                <div class="detail-icon">
                                    <i class="fa-solid fa-calendar-xmark"></i>
                                </div>
                                <div class="detail-info">
                                    <span class="detail-label">Berakhir</span>
                                    <span class="detail-value">{{ $expiresAt->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="subscription-panel inactive">
                    <div class="subscription-content">
                        <div class="subscription-header">
                            <div class="subscription-badge inactive-badge">
                                <i class="fa-solid fa-crown"></i> NO SUBSCRIPTION
                            </div>
                        </div>

                        <div class="no-subscription-message">
                            <p class="mb-2">Anda belum memiliki langganan aktif.</p>
                            <a href="{{ route('employer.manage-plan') }}" class="btn btn-light btn-sm">
                                <i class="fa-solid fa-shopping-cart me-1"></i> Beli Langganan
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .subscription-panel {
            border-radius: 16px;
            padding: 25px;
            color: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .subscription-panel.inactive {
            background: linear-gradient(135deg, #6b7280, #4b5563);
        }

        .subscription-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .subscription-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.2);
        }

        .subscription-badge.inactive-badge {
            background: rgba(255, 255, 255, 0.15);
        }

        .subscription-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .subscription-status.active .fa-circle {
            color: #22c55e;
            font-size: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .subscription-details {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .detail-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .detail-info {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 12px;
            opacity: 0.9;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 600;
        }

        .no-subscription-message {
            text-align: center;
            padding: 10px 0;
        }

        .no-subscription-message p {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .subscription-details {
                flex-direction: column;
                gap: 15px;
            }

            .subscription-header {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
@endpush
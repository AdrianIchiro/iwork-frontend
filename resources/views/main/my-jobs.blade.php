@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h4 class="fw-bold mb-4">Lamaran Saya</h4>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (count($applications) === 0)
            <div class="card-custom text-center py-5">
                <i class="fa-solid fa-briefcase fs-1 text-muted mb-3"></i>
                <p class="text-muted mb-3">Anda belum melamar pekerjaan apapun.</p>
                <a href="{{ route('main.jobs') }}" class="btn btn-primary">
                    <i class="fa-solid fa-search me-1"></i> Cari Lowongan
                </a>
            </div>
        @else
            <div class="card-custom p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Posisi</th>
                                <th>Perusahaan</th>
                                <th>Lokasi</th>
                                <th>Gaji</th>
                                <th>Tanggal Melamar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <td class="ps-3 fw-semibold">{{ $application['job']['title'] }}</td>
                                    <td>{{ $application['job']['employer']['user']['name'] ?? 'Unknown' }}</td>
                                    <td>{{ $application['job']['location'] }}</td>
                                    <td>Rp {{ number_format($application['job']['salary']) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($application['appliedAt'])->format('d M Y') }}</td>
                                    <td>
                                        @php
                                            $statusConfig = match ($application['status']) {
                                                'ACCEPTED' => ['class' => 'bg-success', 'icon' => 'fa-check-circle', 'text' => 'Diterima'],
                                                'REJECTED' => ['class' => 'bg-danger', 'icon' => 'fa-times-circle', 'text' => 'Ditolak'],
                                                'REVIEWING' => ['class' => 'bg-info', 'icon' => 'fa-eye', 'text' => 'Sedang Direview'],
                                                default => ['class' => 'bg-warning text-dark', 'icon' => 'fa-clock', 'text' => 'Pending']
                                            };
                                        @endphp
                                        <span class="badge {{ $statusConfig['class'] }}">
                                            <i class="fa-solid {{ $statusConfig['icon'] }} me-1"></i>
                                            {{ $statusConfig['text'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .card-custom {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        }

        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
        }
    </style>
@endpush
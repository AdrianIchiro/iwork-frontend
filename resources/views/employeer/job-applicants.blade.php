@extends('layouts.employe')

@section('content')
    <div class="mb-4">
        <a href="{{ route('employer.job.detail', $job['id']) }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Detail Job
        </a>
        <h4 class="fw-bold">Daftar Pelamar</h4>
        <p class="text-muted">{{ $job['title'] }}</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (count($applicants) === 0)
        <div class="card-custom text-center py-5">
            <i class="fa-solid fa-inbox fs-1 text-muted mb-3"></i>
            <p class="text-muted mb-0">Belum ada pelamar untuk job ini.</p>
        </div>
    @else
        <div class="card-custom p-0">
            <div class="table-scroll">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Nama</th>
                            <th>Email</th>
                            <th>Tanggal Melamar</th>
                            <th>Status</th>
                            <th>Portfolio</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicants as $applicant)
                            <tr>
                                <td class="ps-3 fw-semibold">{{ $applicant['worker']['user']['name'] }}</td>
                                <td>{{ $applicant['worker']['user']['email'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($applicant['appliedAt'])->format('d M Y H:i') }}</td>
                                <td>
                                    @php
                                        $statusClass = match ($applicant['status']) {
                                            'ACCEPTED' => 'bg-success',
                                            'REJECTED' => 'bg-danger',
                                            'REVIEWING' => 'bg-info',
                                            default => 'bg-warning text-dark'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $applicant['status'] }}</span>
                                </td>
                                <td>
                                    @if (count($applicant['worker']['portfolios'] ?? []) > 0)
                                        <a href="#" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#portfolioModal{{ $applicant['id'] }}">
                                            <i class="fa-solid fa-folder-open"></i>
                                            {{ count($applicant['worker']['portfolios']) }} item
                                        </a>

                                        <!-- Portfolio Modal -->
                                        <div class="modal fade" id="portfolioModal{{ $applicant['id'] }}" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Portfolio - {{ $applicant['worker']['user']['name'] }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach ($applicant['worker']['portfolios'] as $portfolio)
                                                            <div class="border rounded p-3 mb-3">
                                                                <div class="d-flex justify-content-between align-items-start">
                                                                    <div>
                                                                        <h6 class="mb-1">{{ $portfolio['quest']['title'] ?? 'Quest' }}</h6>
                                                                        <span
                                                                            class="badge tier-badge {{ strtolower($portfolio['quest']['tier'] ?? 'entry') }}">
                                                                            {{ $portfolio['quest']['tier'] ?? 'ENTRY' }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="text-end">
                                                                        @if ($portfolio['submission']['rating'] ?? null)
                                                                            <span class="badge bg-success">
                                                                                Rating: {{ $portfolio['submission']['rating'] }}/10
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @if ($portfolio['submission']['fileUrl'] ?? null)
                                                                    <div class="mt-2">
                                                                        <a href="{{ env('API_BASE_URL') }}{{ $portfolio['submission']['fileUrl'] }}"
                                                                            target="_blank" class="btn btn-sm btn-outline-secondary">
                                                                            <i class="fa-solid fa-download"></i> Lihat File
                                                                        </a>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small">Belum ada</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($applicant['status'] === 'PENDING' || $applicant['status'] === 'REVIEWING')
                                        <form action="{{ route('employer.application.update', $applicant['id']) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ACCEPTED">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('employer.application.update', $applicant['id']) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="REJECTED">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@push('styles')
    <style>
        .tier-badge {
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .tier-badge.entry {
            background-color: #00bfff2f;
            color: #00BFFF;
        }

        .tier-badge.mid {
            background-color: #ffe1002d;
            color: #d4a900;
        }

        .tier-badge.high {
            background-color: #ef44442d;
            color: #ef4444;
        }
    </style>
@endpush
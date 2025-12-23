@extends('layouts.employe')

@section('content')
    <div class="mb-4">
        <a href="{{ route('employer.job') }}" class="btn btn-outline-secondary btn-sm mb-3">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <h4 class="fw-bold">Detail Job</h4>
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

    <div class="card-custom mb-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h5 class="mb-2 fw-bold">{{ $job['title'] }}</h5>
                <span
                    class="badge 
                        {{ $job['status'] === 'OPEN' ? 'bg-success' : ($job['status'] === 'UNPAID' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                    {{ $job['status'] }}
                </span>
                <span class="badge bg-info-subtle text-info ms-2">{{ $job['jobType'] }}</span>
            </div>
            <a href="{{ route('employer.job.applicants', $job['id']) }}" class="btn btn-primary">
                <i class="fa-solid fa-users"></i> Lihat Pelamar ({{ $job['_count']['applications'] ?? 0 }})
            </a>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Lokasi</label>
                <p class="mb-0 fw-semibold">{{ $job['location'] }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Gaji</label>
                <p class="mb-0 fw-semibold">Rp {{ number_format($job['salary']) }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Max Pelamar</label>
                <p class="mb-0 fw-semibold">{{ $job['maxApplicants'] ?? 'Tidak terbatas' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Deadline</label>
                <p class="mb-0 fw-semibold">
                    @if ($job['deadline'])
                        {{ \Carbon\Carbon::parse($job['deadline'])->format('d M Y H:i') }}
                    @else
                        Tidak ada deadline
                    @endif
                </p>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label class="text-muted small">Deskripsi</label>
            <p class="mb-0">{{ $job['description'] }}</p>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Dibuat pada</label>
                <p class="mb-0">{{ \Carbon\Carbon::parse($job['createdAt'])->format('d M Y H:i') }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Terakhir diupdate</label>
                <p class="mb-0">{{ \Carbon\Carbon::parse($job['updatedAt'])->format('d M Y H:i') }}</p>
            </div>
        </div>
    </div>
@endsection
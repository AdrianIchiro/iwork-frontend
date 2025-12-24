@extends('layouts.app')

@section('content')
    <!-- SEARCH BAR -->
    <div class="container search-container">
        <form action="{{ route('main.jobs') }}" method="GET">
            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" name="search" class="form-control search-box search-custom"
                    placeholder="Cari pekerjaan..." value="{{ $search ?? '' }}">
            </div>
        </form>
    </div>

    <!-- JOB CARD GRID -->
    <div class="container mt-5">
        <h4 class="fw-bold mb-4">Lowongan Pekerjaan</h4>
        <div class="row g-4">
            @forelse ($jobs as $job)
                <div class="col-md-4">
                    <div class="job-card">
                        <div>
                            <h6 class="fw-bold">{{ $job['title'] }}</h6>
                            <div class="mb-2">
                                <span class="badge bg-info-subtle text-info">{{ $job['jobType'] }}</span>
                            </div>
                            <p class="text-muted small mb-2">
                                <i class="fa-solid fa-location-dot me-1"></i> {{ $job['location'] }}
                            </p>
                            <p class="fw-semibold text-success mb-2">
                                Rp {{ number_format($job['salary']) }}
                            </p>
                            <small class="text-muted">
                                Deadline:
                                @if ($job['deadline'])
                                    {{ \Carbon\Carbon::parse($job['deadline'])->format('d F Y') }}
                                @else
                                    Tidak ada deadline
                                @endif
                            </small>
                        </div>
                        <button class="btn btn-outline-primary mt-3 btn-apply" data-bs-toggle="modal"
                            data-bs-target="#jobModal{{ $job['id'] }}">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Job Detail Modal -->
                <div class="modal fade" id="jobModal{{ $job['id'] }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">{{ $job['title'] }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <span class="badge bg-info-subtle text-info me-2">{{ $job['jobType'] }}</span>
                                    <span class="badge bg-success-subtle text-success">
                                        Rp {{ number_format($job['salary']) }}
                                    </span>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Lokasi</p>
                                        <p class="fw-semibold">{{ $job['location'] }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-1 text-muted small">Deadline</p>
                                        <p class="fw-semibold">
                                            @if ($job['deadline'])
                                                {{ \Carbon\Carbon::parse($job['deadline'])->format('d F Y') }}
                                            @else
                                                Tidak ada deadline
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <p class="mb-1 text-muted small">Pemberi Kerja</p>
                                    <p class="fw-semibold">{{ $job['employer']['user']['name'] ?? 'Unknown' }}</p>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <p class="mb-1 text-muted small">Deskripsi</p>
                                    <p>{{ $job['description'] }}</p>
                                </div>

                                <div class="mb-3">
                                    <p class="mb-1 text-muted small">Info Tambahan</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fa-solid fa-users me-2 text-muted"></i> Max Pelamar:
                                            {{ $job['maxApplicants'] ?? 'Tidak terbatas' }}</li>
                                        <li><i class="fa-solid fa-chart-simple me-2 text-muted"></i> Pelamar Saat Ini:
                                            {{ $job['_count']['applications'] ?? 0 }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary btn-apply-job" data-job-id="{{ $job['id'] }}">
                                    <i class="fa-solid fa-paper-plane me-1"></i> Lamar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fa-solid fa-briefcase fs-1 text-muted mb-3"></i>
                        <p class="text-muted">Belum ada lowongan tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
    <style>
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

        .job-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease;
        }

        .job-card:hover {
            transform: translateY(-3px);
        }

        .job-card h6 {
            min-height: 42px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-apply {
            border-radius: 20px;
            width: 100%;
        }

        .btn-apply-job.applied {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
            cursor: not-allowed;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const applyButtons = document.querySelectorAll('.btn-apply-job');

            applyButtons.forEach(button => {
                button.addEventListener('click', async function () {
                    if (this.classList.contains('applied')) {
                        return;
                    }

                    const jobId = this.dataset.jobId;
                    const originalText = this.innerHTML;

                    this.disabled = true;
                    this.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Melamar...';

                    try {
                        const response = await fetch(`/jobs/${jobId}/apply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            this.innerHTML = '<i class="fa-solid fa-check me-1"></i> Sudah Melamar';
                            this.classList.add('applied');
                            this.classList.remove('btn-primary');
                            this.classList.add('btn-secondary');
                            this.disabled = true;

                            // Close modal after short delay
                            setTimeout(() => {
                                const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
                                if (modal) modal.hide();
                            }, 1000);
                        } else {
                            alert(data.message || 'Gagal melamar pekerjaan.');
                            this.innerHTML = originalText;
                            this.disabled = false;
                        }
                    } catch (error) {
                        console.error('Apply error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }
                });
            });
        });
    </script>
@endpush
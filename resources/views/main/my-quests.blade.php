@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">My Quests</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->has('submit_error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first('submit_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (count($submissions) === 0)
            <div class="text-center py-5">
                <i class="fa-solid fa-folder-open fs-1 text-muted mb-3"></i>
                <p class="text-muted">Anda belum mengambil quest apapun.</p>
                <a href="{{ route('main.quest') }}" class="btn btn-primary">Cari Quest</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($submissions as $submission)
                    @php
                        $quest = $submission['quest'];
                        $isOverdue = $quest['deadline'] && \Carbon\Carbon::parse($quest['deadline'])->isPast();
                        $statusClass = match ($submission['status']) {
                            'COMPLETED' => 'bg-success',
                            'OVERDUE' => 'bg-danger',
                            default => 'bg-warning text-dark'
                        };
                        $statusText = match ($submission['status']) {
                            'COMPLETED' => 'Selesai',
                            'OVERDUE' => 'Terlambat',
                            default => 'Sedang Dikerjakan'
                        };
                    @endphp
                    <div class="col-md-4">
                        <div class="quest-card">
                            <div class="quest-header">
                                <h5 class="quest-title">{{ $quest['title'] }}</h5>
                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                            </div>

                            <span class="level-badge {{ strtolower($quest['tier']) }}">
                                {{ $quest['tier'] }} Level
                            </span>

                            <p class="quest-desc mt-3">{{ $quest['description'] }}</p>

                            <div class="quest-meta">
                                <small class="text-muted">
                                    <i class="fa-regular fa-calendar me-1"></i>
                                    Deadline:
                                    @if ($quest['deadline'])
                                        {{ \Carbon\Carbon::parse($quest['deadline'])->format('d F Y') }}
                                    @else
                                        Tidak ada deadline
                                    @endif
                                </small>
                            </div>

                            @if ($submission['fileUrl'])
                                <div class="mt-2">
                                    <small class="text-success">
                                        <i class="fa-solid fa-check-circle me-1"></i>
                                        File sudah diupload
                                    </small>
                                </div>
                            @endif

                            @if ($submission['isApproved'] === true)
                                <div class="mt-2">
                                    <span class="badge bg-success">
                                        <i class="fa-solid fa-star me-1"></i>
                                        Diterima - Rating: {{ $submission['rating'] }}/5
                                    </span>
                                    @if ($submission['feedback'])
                                        <p class="small text-muted mt-1 mb-0">{{ $submission['feedback'] }}</p>
                                    @endif
                                </div>
                            @elseif ($submission['isApproved'] === false)
                                <div class="mt-2">
                                    <span class="badge bg-danger">Ditolak</span>
                                </div>
                            @endif

                            <div class="quest-actions mt-3">
                                @if (!$isOverdue || $submission['status'] === 'IN_PROGRESS')
                                    <form action="{{ route('quest.submit', $quest['id']) }}" method="POST" enctype="multipart/form-data"
                                        class="submit-form">
                                        @csrf
                                        <div class="input-group input-group-sm mb-2">
                                            <input type="file" name="file" class="form-control" required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-upload me-1"></i>
                                                {{ $submission['fileUrl'] ? 'Resubmit' : 'Submit' }}
                                            </button>
                                        </div>
                                    </form>
                                @endif

                                <form action="{{ route('quest.hide', $submission['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-secondary btn-sm w-100"
                                        onclick="return confirm('Hapus quest ini dari daftar?')">
                                        <i class="fa-solid fa-eye-slash me-1"></i>
                                        Hapus dari Daftar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .quest-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.2s ease;
        }

        .quest-card:hover {
            transform: translateY(-3px);
        }

        .quest-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .quest-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            flex: 1;
            margin-right: 10px;
        }

        .quest-desc {
            font-size: 14px;
            color: #666;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .quest-meta {
            margin-top: auto;
        }

        .quest-actions {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .level-badge {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 7px;
            color: #fff;
            display: inline-block;
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

        .submit-form .form-control {
            font-size: 12px;
        }
    </style>
@endpush
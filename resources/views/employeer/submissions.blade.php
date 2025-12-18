@extends('layouts.employe')

@section('content')
    <div class="mb-4">
        <h4 class="fw-bold">Submission Assessment</h4>
        <p class="text-muted">Review dan nilai submission dari pekerja</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->has('assess_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('assess_error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (count($quests) === 0)
        <div class="card-custom text-center py-5">
            <i class="fa-solid fa-inbox fs-1 text-muted mb-3"></i>
            <p class="text-muted mb-0">Anda belum memiliki quest.</p>
        </div>
    @else
        @foreach ($quests as $quest)
            <div class="card-custom mb-4">
                <div class="quest-header d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="mb-1">{{ $quest['title'] }}</h5>
                        <span class="badge tier-badge {{ strtolower($quest['tier']) }}">
                            {{ $quest['tier'] }}
                        </span>
                    </div>
                    <small class="text-muted">
                        @if ($quest['deadline'])
                            Deadline: {{ \Carbon\Carbon::parse($quest['deadline'])->format('d M Y') }}
                        @else
                            No deadline
                        @endif
                    </small>
                </div>

                <p class="text-muted small mb-3">{{ $quest['description'] }}</p>

                @if (count($quest['submissions']) === 0)
                    <div class="text-center py-3 bg-light rounded">
                        <small class="text-muted">Belum ada submission untuk quest ini</small>
                    </div>
                @else
                    <div class="table-scroll">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Worker</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>Submitted</th>
                                    <th>Assessment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quest['submissions'] as $submission)
                                    <tr>
                                        <td>
                                            <strong>{{ $submission['worker']['user']['name'] }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $submission['worker']['user']['email'] }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match ($submission['status']) {
                                                    'COMPLETED' => 'bg-success',
                                                    'OVERDUE' => 'bg-danger',
                                                    default => 'bg-warning text-dark'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $submission['status'] }}</span>
                                        </td>
                                        <td>
                                            @if ($submission['fileUrl'])
                                                <a href="{{ env('API_BASE_URL') }}{{ $submission['fileUrl'] }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fa-solid fa-download"></i> Download
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ \Carbon\Carbon::parse($submission['submittedAt'])->format('d M Y H:i') }}</small>
                                        </td>
                                        <td>
                                            @if ($submission['isApproved'] === true)
                                                <span class="badge bg-success">Approved</span>
                                                <br>
                                                <small>Rating: {{ $submission['rating'] }}/10</small>
                                            @elseif ($submission['isApproved'] === false)
                                                <span class="badge bg-danger">Rejected</span>
                                            @else
                                                <span class="badge bg-secondary">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($submission['isApproved'] === null && $submission['fileUrl'])
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#assessModal{{ $submission['id'] }}">
                                                    <i class="fa-solid fa-clipboard-check"></i> Assess
                                                </button>

                                                <!-- Assessment Modal -->
                                                <div class="modal fade" id="assessModal{{ $submission['id'] }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('employer.assess', $submission['id']) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Assess Submission</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="mb-3">
                                                                        <strong>Worker:</strong>
                                                                        {{ $submission['worker']['user']['name'] }}
                                                                    </p>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Approval Status</label>
                                                                        <div class="d-flex gap-3">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="isApproved"
                                                                                    id="approve{{ $submission['id'] }}" value="true" required>
                                                                                <label class="form-check-label"
                                                                                    for="approve{{ $submission['id'] }}">
                                                                                    <i class="fa-solid fa-check text-success"></i>
                                                                                    Approve
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="isApproved"
                                                                                    id="reject{{ $submission['id'] }}" value="false">
                                                                                <label class="form-check-label"
                                                                                    for="reject{{ $submission['id'] }}">
                                                                                    <i class="fa-solid fa-xmark text-danger"></i>
                                                                                    Reject
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Rating (1-10)</label>
                                                                        <input type="number" name="rating" class="form-control" min="1" max="10"
                                                                            required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label">Feedback</label>
                                                                        <textarea name="feedback" class="form-control" rows="3" required
                                                                            placeholder="Berikan feedback untuk pekerja..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Submit Assessment</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif (!$submission['fileUrl'])
                                                <span class="text-muted small">No file yet</span>
                                            @else
                                                <span class="text-muted small">Assessed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @endforeach
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

        .quest-header h5 {
            font-weight: 600;
        }
    </style>
@endpush
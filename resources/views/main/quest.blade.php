@extends('layouts.app')

@section('content')
    <!-- SEARCH BAR -->
    <div class="container search-container">
        <form action="{{ route('main.quest') }}" method="GET">
            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>

                <input type="text" name="search" class="form-control search-box search-custom" placeholder="Search"
                    value="{{ $search }}">
            </div>
        </form>
    </div>

    <!-- JOB CARD GRID -->
    <div class="container mt-5">
        <div class="row g-4 justify-content-center">


            @foreach ($quests as $q)
                <div class="col-md-3">
                    <div class="job-card">

                        <div>
                            <h6>{{ $q['title'] }}</h6>

                            <span class="level-badge {{ strtolower($q['tier']) }}">
                                {{ $q['tier'] }} Level
                            </span>

                            <p class="mt-3 mb-1" style="font-size: 14px;">
                                {{ $q['description'] }}
                            </p>

                            <small class="text-muted">
                                Deadline:
                                @if ($q['deadline'])
                                    {{ \Carbon\Carbon::parse($q['deadline'])->format('d F Y') }}
                                @else
                                    Tidak ada deadline
                                @endif
                            </small>
                        </div>

                        <button class="btn btn-outline-info mt-3 btn-bid" data-quest-id="{{ $q['id'] }}">
                            Bid
                        </button>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* NAVBAR */
        .navbar-brand {
            font-weight: 700;
            font-size: 22px;
        }

        /* SEARCH BAR */
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

        /* CARD JOB */
        .job-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .job-card h6 {
            min-height: 42px;
            /* konsisten */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .job-card p {
            min-height: 60px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .job-card:hover {
            transform: translateY(-3px);
        }

        .level-badge {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 7px;
            color: #fff;
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

        .btn-bid {
            border-radius: 20px;
            width: 100%;
        }

        .btn-bid.bidded {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
            color: #fff;
            cursor: not-allowed;
        }

        .btn-bid.bidded:hover {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 0.7)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bidButtons = document.querySelectorAll('.btn-bid');

            bidButtons.forEach(button => {
                button.addEventListener('click', async function () {
                    if (this.classList.contains('bidded')) {
                        return; // Already bidded, do nothing
                    }

                    const questId = this.dataset.questId;
                    const originalText = this.textContent;

                    // Show loading state
                    this.disabled = true;
                    this.textContent = 'Loading...';

                    try {
                        const response = await fetch(`/quest/${questId}/bid`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.success) {
                            // Success - change to bidded state
                            this.textContent = 'Bidded';
                            this.classList.remove('btn-outline-info');
                            this.classList.add('bidded');
                            this.disabled = true;
                        } else {
                            // Error - show message and restore button
                            alert(data.message || 'Gagal mengambil quest.');
                            this.textContent = originalText;
                            this.disabled = false;
                        }
                    } catch (error) {
                        console.error('Bid error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        this.textContent = originalText;
                        this.disabled = false;
                    }
                });
            });
        });
    </script>
@endpush
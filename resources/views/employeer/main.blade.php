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
                <h2 class="fw-bold">0</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-custom">
                <h6 class="text-muted mb-1">Sisa One-Time Quota</h6>
                <h2 class="fw-bold">0</h2>
            </div>
        </div>

    </div>
@endsection

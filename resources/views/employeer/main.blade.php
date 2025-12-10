@extends('layouts.employe')

@section('content')
    <h3 class="fw-bold mb-4">Employer Dashboard</h3>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card-custom">
                <h6 class="text-muted mb-1">Total Quest Dibuat</h6>
                <h2 class="fw-bold">0</h2>
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


    {{-- HEADER QUEST --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">Quest Terbaru</h5>
        <a href="" class="btn btn-primary">
            + Tambah Quest
        </a>
    </div>


    {{-- TABEL QUEST --}}
    <div class="card-custom p-0">

        {{-- WRAPPER RESPONSIVE --}}
        <div class="table-responsive">
            <table class="table mb-0 table-hover align-middle">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th class="py-3">Judul</th>
                        <th>Tier</th>
                        <th>Max Submit</th>
                        <th>Deadline</th>
                        <th>Submission</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Jika ada data --}}
                    {{--
                @forelse ($quests as $q)
                    <tr>
                        <td class="py-3">{{ $q->title }}</td>
                        <td>{{ $q->tier }}</td>
                        <td>{{ $q->maxSubmissions }}</td>
                        <td>{{ $q->deadline ?? '-' }}</td>
                        <td>{{ $q->submissions_count }}</td>

                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-outline-danger ms-2">Hapus</a>
                        </td>
                    </tr>
                @empty
                --}}
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada quest yang dibuat
                        </td>
                    </tr>
                    {{-- @endforelse --}}
                </tbody>
            </table>
        </div>

    </div>
@endsection

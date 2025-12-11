@extends('layouts.employe')

@section('content')
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

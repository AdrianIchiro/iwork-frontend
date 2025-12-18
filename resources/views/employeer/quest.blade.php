@extends('layouts.employe')

@section('content')
    {{-- HEADER QUEST --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">Quest Terbaru</h5>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahQuest">
            + Tambah Quest
        </a>
    </div>

    {{-- TABEL QUEST --}}

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-custom p-0 shadow-sm rounded-3">

        {{-- MOBILE SCROLL WRAPPER --}}
        <div class="table-scroll">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Judul</th>
                        <th>Tier</th>
                        <th>Max Submit</th>
                        <th>Deadline</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($quests as $q)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $q['title'] }}</td>

                            <td>
                                <span class="badge
                                                @if ($q['tier'] === 'HIGH') bg-danger-subtle text-danger
                                                @elseif ($q['tier'] === 'MID')
                                                    bg-warning-subtle text-warning
                                                @else
                                                bg-success-subtle text-success @endif
                                            ">
                                    {{ strtoupper($q['tier']) }}
                                </span>
                            </td>

                            <td>{{ $q['maxSubmissions'] }}</td>

                            <td class="text-nowrap">
                                {{ $q['deadline'] ? \Carbon\Carbon::parse($q['deadline'])->format('d M Y H:i') : '-' }}
                            </td>

                            <td class="text-end pe-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $q['id'] }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('quest.delete', $q['id']) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus quest ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $q['id'] }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('quest.update', $q['id']) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-semibold">Edit Quest</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label">Judul Quest</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $q['title'] }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea name="description" class="form-control" rows="3"
                                                            required>{{ $q['description'] }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Tier</label>
                                                            <select name="tier" class="form-control" required>
                                                                <option value="ENTRY" {{ $q['tier'] === 'ENTRY' ? 'selected' : '' }}>Entry</option>
                                                                <option value="MID" {{ $q['tier'] === 'MID' ? 'selected' : '' }}>
                                                                    Mid</option>
                                                                <option value="HIGH" {{ $q['tier'] === 'HIGH' ? 'selected' : '' }}>High</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Max Submissions</label>
                                                            <input type="number" name="maxSubmissions" class="form-control"
                                                                value="{{ $q['maxSubmissions'] }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Deadline</label>
                                                        <input type="datetime-local" name="deadline" class="form-control"
                                                            value="{{ $q['deadline'] ? \Carbon\Carbon::parse($q['deadline'])->format('Y-m-d\TH:i') : '' }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada quest yang dibuat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>


    <!-- Modal Tambah Quest -->
    <div class="modal fade" id="modalTambahQuest" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('quest.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold">Tambah Quest Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Judul Quest</label>
                            <input type="text" name="title" class="form-control" placeholder="Masukkan judul quest..."
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" required
                                placeholder="Jelaskan tugas quest..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tier</label>
                                <select name="tier" class="form-control" required>
                                    <option value="">Pilih Tier</option>
                                    <option value="ENTRY">Entry</option>
                                    <option value="MID">Mid</option>
                                    <option value="HIGH">High</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Max Submissions</label>
                                <input type="number" name="maxSubmissions" class="form-control" value="10" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tipe Kuota</label>
                                <select name="quotaType" class="form-control" required>
                                    <option value="SUBSCRIPTION">Subscription</option>
                                    <option value="ONE_TIME">One Time</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="datetime-local" name="deadline" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Quest</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
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
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- Jika ada data --}}
                    @forelse ($quests as $q)
                        <tr>
                            <td class="py-3">{{ $q['title'] }}</td>
                            <td>{{ $q['tier'] }}</td>
                            <td>{{ $q['maxSubmissions'] }}</td>
                            <td>{{ $q['deadline'] ? \Carbon\Carbon::parse($q['deadline'])->format('d M Y H:i') : '-' }}</td>

                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="#" class="btn btn-sm btn-outline-danger ms-2">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
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
                            <textarea name="description" class="form-control" rows="3" required placeholder="Jelaskan tugas quest..."></textarea>
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

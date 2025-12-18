@extends('layouts.employe')

@section('content')
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-semibold">Job Terbaru</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahJob">
            + Tambah Job
        </button>
    </div>

    {{-- ALERT --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- TABLE JOB --}}
    <div class="card-custom p-0 shadow-sm rounded-3">
        <div class="table-scroll">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Judul</th>
                        <th>Lokasi</th>
                        <th>Gaji</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $job['title'] }}</td>
                            <td>{{ $job['location'] }}</td>
                            <td>Rp {{ number_format($job['salary']) }}</td>
                            <td>
                                <span class="badge bg-info-subtle text-info">
                                    {{ $job['jobType'] }}
                                </span>
                            </td>
                            <td>
                                <span
                                    class="badge
                                    {{ $job['status'] === 'UNPAID' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' }}">
                                    {{ $job['status'] }}
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <span class="text-muted small">Menunggu pembayaran</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada job dibuat
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL CREATE JOB --}}
    <div class="modal fade" id="modalTambahJob" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('job.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title fw-semibold">Tambah Job Baru</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Judul Job</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lokasi (Text)</label>
                                <input type="text" name="location" class="form-control"
                                    placeholder="Contoh: Bandung, Jawa Barat" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gaji</label>
                                <input type="number" name="salary" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tipe Job</label>
                                <select name="jobType" class="form-control" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="FULL_TIME">Full Time</option>
                                    <option value="PART_TIME">Part Time</option>
                                    <option value="FREELANCE">Freelance</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Max Pelamar</label>
                                <input type="number" name="maxApplicants" class="form-control" value="50">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Deadline</label>
                                <input type="datetime-local" name="deadline" class="form-control">
                            </div>
                        </div>

                        {{-- MAP PICKER --}}
                        <div class="mb-3">
                            <label class="form-label">Lokasi di Peta</label>
                            <div id="map" style="height: 320px; border-radius: 10px;"></div>
                            <small class="text-muted">
                                Klik peta / cari lokasi → koordinat terisi otomatis
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">
                            Buat Job & Bayar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
@endsection

@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Total Aspirasi</div>
            <div class="fs-2 fw-600">{{ $stats['total'] }}</div>
            <div class="text-primary small"><i class="bi bi-inbox"></i> Semua masuk</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Menunggu</div>
            <div class="fs-2 fw-600 text-warning">{{ $stats['pending'] }}</div>
            <div class="text-warning small"><i class="bi bi-clock"></i> Belum diproses</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Diproses</div>
            <div class="fs-2 fw-600 text-info">{{ $stats['on_progress'] }}</div>
            <div class="text-info small"><i class="bi bi-arrow-repeat"></i> Sedang ditangani</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Selesai</div>
            <div class="fs-2 fw-600 text-success">{{ $stats['resolved'] }}</div>
            <div class="text-success small"><i class="bi bi-check-circle"></i> Terselesaikan</div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Ditolak</div>
            <div class="fs-2 fw-600 text-danger">{{ $stats['rejected'] }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Kategori Aktif</div>
            <div class="fs-2 fw-600">{{ $stats['categories'] }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Total Siswa</div>
            <div class="fs-2 fw-600">{{ $stats['students'] }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-600">Aspirasi Terbaru</h6>
        <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest as $asp)
                <tr>
                    <td>{{ Str::limit($asp->title, 40) }}</td>
                    <td>{{ $asp->user->name }}</td>
                    <td><span class="badge bg-secondary">{{ $asp->category->name }}</span></td>
                    <td>
                        <span class="badge bg-{{ $asp->status_color }}">{{ $asp->status_label }}</span>
                    </td>
                    <td class="text-muted small">{{ $asp->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.aspirasi.show', $asp) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada aspirasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

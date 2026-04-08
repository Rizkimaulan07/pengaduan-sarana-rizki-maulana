@extends('layouts.siswa')
@section('title', 'Dashboard Siswa')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h5 class="fw-600">Selamat datang, {{ auth()->user()->name }} 👋</h5>
    <p class="text-muted">Sampaikan aspirasi dan pengaduanmu di sini.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-600">{{ $stats['total'] }}</div>
            <div class="text-muted small">Total Aspirasi</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-600 text-warning">{{ $stats['pending'] }}</div>
            <div class="text-muted small">Menunggu</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-600 text-info">{{ $stats['on_progress'] }}</div>
            <div class="text-muted small">Diproses</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-600 text-success">{{ $stats['resolved'] }}</div>
            <div class="text-muted small">Selesai</div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="fw-600 mb-0">Aspirasi Terbaru Saya</h6>
    <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-sm btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Kirim Aspirasi Baru
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($latest as $asp)
                <tr>
                    <td>{{ Str::limit($asp->title, 45) }}</td>
                    <td><span class="badge bg-secondary">{{ $asp->category->name }}</span></td>
                    <td><span class="badge bg-{{ $asp->status_color }}">{{ $asp->status_label }}</span></td>
                    <td class="text-muted small">{{ $asp->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('siswa.aspirasi.show', $asp) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        Belum ada aspirasi.<br>
                        <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary btn-sm mt-2">
                            Kirim Aspirasi Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(count($latest) > 0)
    <div class="card-footer bg-white text-end">
        <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    @endif
</div>
@endsection

@extends('layouts.siswa')
@section('title', 'Detail Aspirasi')
@section('page-title', 'Detail Aspirasi')

@section('content')
<div class="mb-3">
    <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        {{-- Detail Aspirasi --}}
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-600 mb-1">{{ $aspirasi->title }}</h5>
                        <div class="text-muted small">
                            <i class="bi bi-tag me-1"></i>{{ $aspirasi->category->name }}
                            &nbsp;·&nbsp;
                            <i class="bi bi-calendar me-1"></i>{{ $aspirasi->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <span class="badge bg-{{ $aspirasi->status_color }} fs-6">{{ $aspirasi->status_label }}</span>
                </div>
                <hr>
                <p class="mb-0" style="white-space: pre-wrap;">{{ $aspirasi->content }}</p>
            </div>
        </div>

        {{-- Umpan Balik dari Admin --}}
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-600"><i class="bi bi-chat-square-text me-2"></i>Umpan Balik dari Admin</h6>
            </div>
            <div class="card-body">
                @forelse($aspirasi->feedbacks as $fb)
                <div class="border rounded p-3 mb-3" style="border-left: 3px solid #0f766e !important;">
                    <div class="d-flex justify-content-between small text-muted mb-2">
                        <span><i class="bi bi-person-badge me-1"></i>{{ $fb->admin->name }}</span>
                        <span>{{ $fb->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <p class="mb-0" style="white-space:pre-wrap;">{{ $fb->message }}</p>
                </div>
                @empty
                <div class="text-center text-muted py-4">
                    <i class="bi bi-chat-square fs-2 d-block mb-2"></i>
                    Belum ada umpan balik dari admin.
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Progres Perbaikan --}}
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-600"><i class="bi bi-list-check me-2"></i>Progres Perbaikan</h6>
            </div>
            <div class="card-body p-0">
                @forelse($aspirasi->progressUpdates as $pu)
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="badge bg-info text-dark">{{ $pu->stage_label }}</span>
                        <span class="text-muted" style="font-size:.72rem;">{{ $pu->created_at->format('d M Y') }}</span>
                    </div>
                    <p class="mb-0 small" style="white-space:pre-wrap;">{{ $pu->description }}</p>
                </div>
                @empty
                <div class="text-center text-muted py-4 px-3">
                    <i class="bi bi-hourglass fs-2 d-block mb-2"></i>
                    Belum ada update progres.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.siswa')
@section('title', 'Aspirasi Saya')
@section('page-title', 'Aspirasi Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">Semua aspirasi yang pernah kamu kirimkan.</p>
    <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary btn-sm">
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
                    <th>Tanggal Kirim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirations as $asp)
                <tr>
                    <td>{{ Str::limit($asp->title, 50) }}</td>
                    <td><span class="badge bg-secondary">{{ $asp->category->name }}</span></td>
                    <td><span class="badge bg-{{ $asp->status_color }}">{{ $asp->status_label }}</span></td>
                    <td class="text-muted small">{{ $asp->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('siswa.aspirasi.show', $asp) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye me-1"></i>Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        Kamu belum mengirim aspirasi apapun.<br>
                        <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-primary btn-sm mt-2">
                            Kirim Sekarang
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($aspirations->hasPages())
    <div class="card-footer bg-white">{{ $aspirations->links() }}</div>
    @endif
</div>
@endsection

@extends('layouts.admin')
@section('title', 'Daftar Aspirasi')
@section('page-title', 'Manajemen Aspirasi')

@section('content')
<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-2">
                <label class="form-label small mb-1">Tanggal</label>
                <input type="date" name="date" class="form-control form-control-sm" value="{{ request('date') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">Bulan</label>
                <select name="month" class="form-select form-select-sm">
                    <option value="">Semua Bulan</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">Siswa</label>
                <select name="user_id" class="form-select form-select-sm">
                    <option value="">Semua Siswa</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" {{ request('user_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">Kategori</label>
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small mb-1">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Aspiration::STATUS_LABELS as $val => $label)
                        <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button class="btn btn-sm btn-primary w-100"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-sm btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-600">
            Daftar Aspirasi
            <span class="badge bg-secondary ms-2">{{ $aspirations->total() }}</span>
        </h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Siswa</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirations as $asp)
                <tr>
                    <td class="text-muted small">{{ $asp->id }}</td>
                    <td>{{ Str::limit($asp->title, 45) }}</td>
                    <td>{{ $asp->user->name }}</td>
                    <td><span class="badge bg-secondary">{{ $asp->category->name }}</span></td>
                    <td><span class="badge bg-{{ $asp->status_color }}">{{ $asp->status_label }}</span></td>
                    <td class="text-muted small">{{ $asp->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.aspirasi.show', $asp) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">Tidak ada aspirasi ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($aspirations->hasPages())
    <div class="card-footer bg-white">
        {{ $aspirations->links() }}
    </div>
    @endif
</div>
@endsection

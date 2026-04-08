@extends('layouts.siswa')
@section('title', 'Kirim Aspirasi')
@section('page-title', 'Kirim Aspirasi Baru')

@section('content')
<div class="mb-3">
    <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width:680px;">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-600"><i class="bi bi-megaphone me-2"></i>Form Kirim Aspirasi</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('siswa.aspirasi.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-500">Kategori <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                            @if($cat->description) — {{ Str::limit($cat->description, 40) }}@endif
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label small fw-500">Judul Aspirasi <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title') }}"
                       placeholder="Contoh: Kursi kelas 9A banyak yang rusak" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label small fw-500">Isi Pengaduan <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                          rows="6" placeholder="Jelaskan masalah atau aspirasimu secara detail..."
                          required>{{ old('content') }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <div class="form-text">Jelaskan lokasi, kondisi, dan dampak dari masalah yang kamu laporkan.</div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i>Kirim Aspirasi
                </button>
                <a href="{{ route('siswa.aspirasi.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

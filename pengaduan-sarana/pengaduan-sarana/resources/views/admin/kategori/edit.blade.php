@extends('layouts.admin')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-600">Edit Kategori: {{ $kategori->name }}</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.kategori.update', $kategori) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label small fw-500">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $kategori->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label small fw-500">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $kategori->description) }}</textarea>
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                    {{ old('is_active', $kategori->is_active) ? 'checked' : '' }}>
                <label class="form-check-label small" for="isActive">Aktif (tampil ke siswa)</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Perbarui Kategori
                </button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

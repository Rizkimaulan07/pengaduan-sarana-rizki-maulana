<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            width: 240px; min-height: 100vh;
            background: #1e293b; color: #cbd5e1;
            position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column;
        }
        .sidebar .brand {
            padding: 1.25rem 1.5rem;
            font-size: 1rem; font-weight: 600;
            color: #fff; border-bottom: 1px solid #334155;
        }
        .sidebar .nav-link {
            color: #94a3b8; padding: .65rem 1.5rem;
            border-radius: 0; display: flex; align-items: center; gap: .6rem;
            font-size: .9rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff; background: #334155;
        }
        .sidebar .nav-section {
            font-size: .7rem; text-transform: uppercase;
            letter-spacing: .08em; color: #475569;
            padding: 1rem 1.5rem .35rem;
        }
        .main-content { margin-left: 240px; padding: 2rem; }
        .topbar {
            background: #fff; border-bottom: 1px solid #e2e8f0;
            padding: .75rem 2rem; margin-left: 240px;
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
        }
        .badge-status { font-size: .72rem; }
        .card { border: 1px solid #e2e8f0; box-shadow: none; }
        .table th { font-size: .8rem; text-transform: uppercase;
            letter-spacing: .05em; color: #64748b; font-weight: 500; }
    </style>
    @stack('styles')
</head>
<body>
<div class="sidebar">
    <div class="brand"><i class="bi bi-megaphone-fill me-2"></i>Pengaduan Sarana</div>
    <nav class="flex-grow-1 pt-2">
        <div class="nav-section">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <div class="nav-section">Manajemen</div>
        <a href="{{ route('admin.aspirasi.index') }}" class="nav-link {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
            <i class="bi bi-inbox"></i> Aspirasi
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Kategori
        </a>
    </nav>
    <div class="p-3 border-top border-secondary">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white"
                 style="width:32px;height:32px;font-size:.8rem;font-weight:600;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="font-size:.85rem;">
                <div class="text-white fw-500">{{ auth()->user()->name }}</div>
                <div class="text-secondary" style="font-size:.75rem;">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-outline-secondary w-100">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </button>
        </form>
    </div>
</div>

<div class="topbar">
    <h6 class="mb-0 fw-500">@yield('page-title', 'Dashboard')</h6>
    <small class="text-muted">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</small>
</div>

<div class="main-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

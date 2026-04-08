<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Siswa') — Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f0f9ff; }
        .sidebar {
            width: 240px; min-height: 100vh;
            background: #0f766e; color: #ccfbf1;
            position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column;
        }
        .sidebar .brand {
            padding: 1.25rem 1.5rem;
            font-size: 1rem; font-weight: 600;
            color: #fff; border-bottom: 1px solid #0d9488;
        }
        .sidebar .nav-link {
            color: #99f6e4; padding: .65rem 1.5rem;
            border-radius: 0; display: flex; align-items: center; gap: .6rem;
            font-size: .9rem;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff; background: #0d9488;
        }
        .sidebar .nav-section {
            font-size: .7rem; text-transform: uppercase;
            letter-spacing: .08em; color: #5eead4;
            padding: 1rem 1.5rem .35rem;
        }
        .main-content { margin-left: 240px; padding: 2rem; }
        .topbar {
            background: #fff; border-bottom: 1px solid #e2e8f0;
            padding: .75rem 2rem; margin-left: 240px;
            position: sticky; top: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
        }
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
        <div class="nav-section">Menu</div>
        <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('siswa.aspirasi.index') }}" class="nav-link {{ request()->routeIs('siswa.aspirasi.*') ? 'active' : '' }}">
            <i class="bi bi-chat-square-text"></i> Aspirasi Saya
        </a>
        <a href="{{ route('siswa.aspirasi.create') }}" class="nav-link">
            <i class="bi bi-plus-circle"></i> Kirim Aspirasi
        </a>
    </nav>
    <div class="p-3 border-top" style="border-color:#0d9488!important;">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center"
                 style="width:32px;height:32px;font-size:.8rem;font-weight:600;color:#0f766e;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="font-size:.85rem;">
                <div class="text-white fw-500">{{ auth()->user()->name }}</div>
                <div style="color:#99f6e4;font-size:.75rem;">Siswa</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm w-100" style="background:#0d9488;color:#fff;border:none;">
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
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Pengaduan Sarana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh; background: linear-gradient(135deg, #0f766e 0%, #1e293b 100%);
            display: flex; align-items: center; justify-content: center;
        }
        .login-card {
            background: #fff; border-radius: 16px; padding: 2.5rem;
            width: 100%; max-width: 400px; box-shadow: 0 20px 60px rgba(0,0,0,.2);
        }
        .login-icon {
            width: 56px; height: 56px; background: #0f766e;
            border-radius: 14px; display: flex; align-items: center;
            justify-content: center; margin: 0 auto 1.5rem;
        }
        .form-control:focus { border-color: #0f766e; box-shadow: 0 0 0 .2rem rgba(15,118,110,.15); }
        .btn-primary { background: #0f766e; border-color: #0f766e; }
        .btn-primary:hover { background: #0d9488; border-color: #0d9488; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="text-center">
        <div class="login-icon">
            <i class="bi bi-megaphone-fill text-white fs-4"></i>
        </div>
        <h5 class="fw-600 mb-1">Pengaduan Sarana</h5>
        <p class="text-muted small mb-4">Silakan login untuk melanjutkan</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger py-2 small">
            <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-500">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="contoh@sekolah.id" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label small fw-500">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="pwdField"
                       class="form-control" placeholder="••••••••" required>
                <button class="btn btn-outline-secondary" type="button"
                        onclick="togglePwd()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label small" for="remember">Ingat saya</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
        </button>
    </form>

    <hr class="my-3">
    <p class="text-center text-muted small mb-0">
        Akun demo:<br>
        Admin: <strong>admin@sekolah.id</strong> / <strong>password</strong><br>
        Siswa: <strong>siswa@sekolah.id</strong> / <strong>password</strong>
    </p>
</div>

<script>
function togglePwd() {
    const f = document.getElementById('pwdField');
    const i = document.getElementById('eyeIcon');
    if (f.type === 'password') { f.type = 'text'; i.className = 'bi bi-eye-slash'; }
    else { f.type = 'password'; i.className = 'bi bi-eye'; }
}
</script>
</body>
</html>

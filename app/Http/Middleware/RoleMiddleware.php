<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): mixed
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
            if (auth()->check()) {
                $redirect = auth()->user()->isAdmin() ? '/admin/dashboard' : '/siswa/dashboard';
                return redirect($redirect)->with('error', 'Akses tidak diizinkan.');
            }
            return redirect('/login');
        }

        return $next($request);
    }
}

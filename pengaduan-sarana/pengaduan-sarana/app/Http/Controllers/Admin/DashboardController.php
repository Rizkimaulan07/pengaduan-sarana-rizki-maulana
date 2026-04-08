<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'       => Aspiration::count(),
            'pending'     => Aspiration::where('status', 'pending')->count(),
            'on_progress' => Aspiration::where('status', 'on_progress')->count(),
            'resolved'    => Aspiration::where('status', 'resolved')->count(),
            'rejected'    => Aspiration::where('status', 'rejected')->count(),
            'categories'  => Category::count(),
            'students'    => User::where('role', 'siswa')->count(),
        ];

        $latest = Aspiration::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest'));
    }
}

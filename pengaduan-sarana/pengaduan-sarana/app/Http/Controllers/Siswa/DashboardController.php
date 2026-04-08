<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'       => Aspiration::where('user_id', auth()->id())->count(),
            'pending'     => Aspiration::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'on_progress' => Aspiration::where('user_id', auth()->id())->where('status', 'on_progress')->count(),
            'resolved'    => Aspiration::where('user_id', auth()->id())->where('status', 'resolved')->count(),
        ];

        $latest = Aspiration::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact('stats', 'latest'));
    }
}

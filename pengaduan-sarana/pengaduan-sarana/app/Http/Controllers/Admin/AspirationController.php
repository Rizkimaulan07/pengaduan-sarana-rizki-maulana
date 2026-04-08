<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\ProgressUpdate;
use App\Models\User;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function index(Request $request)
    {
        $query = Aspiration::with(['user', 'category'])->latest();

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->month);
        }
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $aspirations = $query->paginate(15)->withQueryString();
        $categories  = Category::active()->get();
        $students    = User::where('role', 'siswa')->orderBy('name')->get();

        return view('admin.aspirasi.index', compact('aspirations', 'categories', 'students'));
    }

    public function show(Aspiration $aspiration)
    {
        $aspiration->load(['user', 'category', 'feedbacks.admin', 'progressUpdates.admin']);
        return view('admin.aspirasi.show', compact('aspiration'));
    }

    public function updateStatus(Request $request, Aspiration $aspiration)
    {
        $request->validate([
            'status' => 'required|in:pending,on_progress,resolved,rejected',
        ]);

        $aspiration->update(['status' => $request->status]);

        return back()->with('success', 'Status aspirasi berhasil diperbarui.');
    }

    public function storeFeedback(Request $request, Aspiration $aspiration)
    {
        $request->validate(['message' => 'required|string|max:2000']);

        Feedback::create([
            'aspiration_id' => $aspiration->id,
            'admin_id'      => auth()->id(),
            'message'       => $request->message,
        ]);

        return back()->with('success', 'Umpan balik berhasil dikirim.');
    }

    public function storeProgress(Request $request, Aspiration $aspiration)
    {
        $request->validate([
            'description' => 'required|string|max:2000',
            'stage'       => 'required|in:diterima,ditinjau,diproses,selesai',
        ]);

        ProgressUpdate::create([
            'aspiration_id' => $aspiration->id,
            'admin_id'      => auth()->id(),
            'description'   => $request->description,
            'stage'         => $request->stage,
        ]);

        return back()->with('success', 'Progres berhasil dicatat.');
    }
}

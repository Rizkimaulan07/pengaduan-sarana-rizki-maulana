<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspiration;
use App\Models\Category;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    public function index()
    {
        $aspirations = Aspiration::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('siswa.aspirasi.index', compact('aspirations'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        return view('siswa.aspirasi.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:200',
            'content'     => 'required|string|max:5000',
        ]);

        Aspiration::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'content'     => $request->content,
        ]);

        return redirect()->route('siswa.aspirasi.index')->with('success', 'Aspirasi berhasil dikirim.');
    }

    public function show(Aspiration $aspirasi)
    {
        if ($aspirasi->user_id !== auth()->id()) {
            abort(403);
        }

        $aspirasi->load(['category', 'feedbacks.admin', 'progressUpdates.admin']);
        return view('siswa.aspirasi.show', compact('aspirasi'));
    }
}

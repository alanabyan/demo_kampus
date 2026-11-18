<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        return view('materi.index', ['materi' => Materi::with('dosen')->latest()->get()]);
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Materi::create($data + ['dosen_id' => $request->user()->id]);

        return redirect()->route('materi.index')->with('status', 'Materi ditambahkan.');
    }

    public function destroy(Request $request, Materi $materi)
    {
        abort_unless($request->user()->hasRole('admin') || $materi->dosen_id === $request->user()->id, 403);

        $materi->delete();

        return back()->with('status', 'Materi dihapus.');
    }
}

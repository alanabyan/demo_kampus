<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /** Admin & dosen: kelola semua nilai. */
    public function index()
    {
        return view('nilai.index', ['nilai' => Nilai::with(['mahasiswa', 'materi'])->latest()->get()]);
    }

    public function create()
    {
        return view('nilai.create', [
            'mahasiswa' => User::where('role', 'mahasiswa')->orderBy('name')->get(),
            'materi' => Materi::orderBy('judul')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mahasiswa_id' => ['required', 'exists:users,id,role,mahasiswa'],
            'materi_id' => ['required', 'exists:materi,id'],
            'nilai' => ['required', 'integer', 'between:0,100'],
        ]);

        Nilai::updateOrCreate(
            ['mahasiswa_id' => $data['mahasiswa_id'], 'materi_id' => $data['materi_id']],
            ['nilai' => $data['nilai']]
        );

        return redirect()->route('nilai.index')->with('status', 'Nilai disimpan.');
    }

    /** Mahasiswa: hanya nilai miliknya sendiri. */
    public function saya(Request $request)
    {
        return view('nilai.saya', ['nilai' => Nilai::with('materi')->where('mahasiswa_id', $request->user()->id)->get()]);
    }
}

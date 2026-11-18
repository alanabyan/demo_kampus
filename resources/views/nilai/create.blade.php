@extends('layouts.app')
@section('title', 'Input Nilai')
@section('content')
<h2>Input Nilai</h2>
<form method="POST" action="{{ route('nilai.store') }}">
    @csrf
    <label>Mahasiswa</label>
    <select name="mahasiswa_id">@foreach($mahasiswa as $m)<option value="{{ $m->id }}">{{ $m->name }}</option>@endforeach</select>
    <label>Materi</label>
    <select name="materi_id">@foreach($materi as $m)<option value="{{ $m->id }}">{{ $m->judul }}</option>@endforeach</select>
    <label>Nilai (0-100)</label><input type="number" name="nilai" min="0" max="100" required>
    <button>Simpan</button>
</form>
@endsection

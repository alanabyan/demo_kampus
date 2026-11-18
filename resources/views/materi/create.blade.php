@extends('layouts.app')
@section('title', 'Tambah Materi')
@section('content')
<h2>Tambah Materi</h2>
<form method="POST" action="{{ route('materi.store') }}">
    @csrf
    <label>Judul</label><input name="judul" value="{{ old('judul') }}" required>
    <label>Deskripsi</label><textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
    <button>Simpan</button>
</form>
@endsection

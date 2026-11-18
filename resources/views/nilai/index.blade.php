@extends('layouts.app')
@section('title', 'Nilai')
@section('content')
<h2>Manajemen Nilai</h2>
<p><a class="btn" href="{{ route('nilai.create') }}">+ Input Nilai</a></p>
<table>
    <tr><th>Mahasiswa</th><th>Materi</th><th>Nilai</th></tr>
    @foreach($nilai as $n)
    <tr><td>{{ $n->mahasiswa->name }}</td><td>{{ $n->materi->judul }}</td><td>{{ $n->nilai }}</td></tr>
    @endforeach
</table>
@endsection

@extends('layouts.app')
@section('title', 'Nilai Saya')
@section('content')
<h2>Nilai Saya</h2>
<table>
    <tr><th>Materi</th><th>Nilai</th></tr>
    @forelse($nilai as $n)
    <tr><td>{{ $n->materi->judul }}</td><td>{{ $n->nilai }}</td></tr>
    @empty
    <tr><td colspan="2">Belum ada nilai.</td></tr>
    @endforelse
</table>
@endsection

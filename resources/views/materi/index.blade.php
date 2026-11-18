@extends('layouts.app')
@section('title', 'Materi')
@section('content')
<h2>Materi</h2>
@if(auth()->user()->hasRole('admin','dosen'))<p><a class="btn" href="{{ route('materi.create') }}">+ Tambah Materi</a></p>@endif
<table>
    <tr><th>Judul</th><th>Deskripsi</th><th>Dosen</th><th></th></tr>
    @foreach($materi as $m)
    <tr>
        <td>{{ $m->judul }}</td><td>{{ $m->deskripsi }}</td><td>{{ $m->dosen->name }}</td>
        <td>@if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('dosen') && $m->dosen_id === auth()->id()))
            <form method="POST" action="{{ route('materi.destroy', $m) }}">@csrf @method('DELETE')<button class="danger">Hapus</button></form>
        @endif</td>
    </tr>
    @endforeach
</table>
@endsection

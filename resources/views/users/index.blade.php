@extends('layouts.app')
@section('title', 'Pengguna')
@section('content')
<h2>Manajemen Pengguna</h2>
<p><a class="btn" href="{{ route('users.create') }}">+ Tambah Pengguna</a></p>
<table>
    <tr><th>Nama</th><th>Email</th><th>Role</th><th></th></tr>
    @foreach($users as $u)
    <tr>
        <td>{{ $u->name }}</td><td>{{ $u->email }}</td><td>{{ $u->role }}</td>
        <td><form method="POST" action="{{ route('users.destroy', $u) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="danger">Hapus</button></form></td>
    </tr>
    @endforeach
</table>
@endsection

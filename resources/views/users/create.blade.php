@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('content')
<h2>Tambah Pengguna</h2>
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <label>Nama</label><input name="name" value="{{ old('name') }}" required>
    <label>Email</label><input type="email" name="email" value="{{ old('email') }}" required>
    <label>Password</label><input type="password" name="password" required>
    <label>Role</label>
    <select name="role">@foreach(\App\Models\User::ROLES as $r)<option value="{{ $r }}">{{ $r }}</option>@endforeach</select>
    <button>Simpan</button>
</form>
@endsection

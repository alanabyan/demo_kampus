@extends('layouts.app')
@section('title', 'Login')
@section('content')
<h2>Login</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <label>Email</label><input type="email" name="email" value="{{ old('email') }}" required>
    <label>Password</label><input type="password" name="password" required>
    <label><input type="checkbox" name="remember" value="1" style="width:auto"> Ingat saya</label><br><br>
    <button>Masuk</button>
</form>
@endsection

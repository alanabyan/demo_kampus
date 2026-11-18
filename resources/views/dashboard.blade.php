@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h2>Selamat datang, {{ auth()->user()->name }}</h2>
<p>Anda login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>
@endsection

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Akademik') - Demo Kampus</title>
    <style>
        body{font-family:system-ui,sans-serif;margin:0;background:#f4f5f7;color:#222}
        nav{background:#1e3a5f;color:#fff;padding:10px 20px;display:flex;gap:16px;align-items:center;flex-wrap:wrap}
        nav a{color:#fff;text-decoration:none}nav .sp{flex:1}
        main{max-width:860px;margin:24px auto;background:#fff;padding:24px;border-radius:8px}
        table{width:100%;border-collapse:collapse}th,td{padding:8px;border-bottom:1px solid #ddd;text-align:left}
        input,select,textarea{width:100%;padding:8px;margin:4px 0 12px;box-sizing:border-box}
        button,.btn{background:#1e3a5f;color:#fff;border:0;padding:8px 14px;border-radius:4px;cursor:pointer;text-decoration:none;display:inline-block}
        .danger{background:#b32d2e}.ok{background:#e6f4ea;padding:8px;border-radius:4px;margin-bottom:12px}
        .err{background:#fde8e8;color:#9b1c1c;padding:8px;border-radius:4px;margin-bottom:12px}
    </style>
</head>
<body>
@auth
<nav>
    <strong>Demo Kampus</strong>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    @if(auth()->user()->hasRole('admin'))<a href="{{ route('users.index') }}">Pengguna</a>@endif
    <a href="{{ route('materi.index') }}">Materi</a>
    @if(auth()->user()->hasRole('admin','dosen'))<a href="{{ route('nilai.index') }}">Nilai</a>@endif
    @if(auth()->user()->hasRole('mahasiswa'))<a href="{{ route('nilai.saya') }}">Nilai Saya</a>@endif
    <span class="sp"></span>
    <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
    <form method="POST" action="{{ route('logout') }}" style="margin:0">@csrf<button class="danger">Logout</button></form>
</nav>
@endauth
<main>
    @if(session('status'))<div class="ok">{{ session('status') }}</div>@endif
    @if($errors->any())<div class="err">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
    @yield('content')
</main>
</body>
</html>

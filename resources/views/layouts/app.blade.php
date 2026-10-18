<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FundTrack') | CCJE SBO</title>
    <style>
        :root { --teal:#148c88; --dark:#075d5b; --bg:#f4f8f8; --line:#dce7e7; }
        * { box-sizing:border-box; }
        body { margin:0; font-family:Arial,sans-serif; background:var(--bg); color:#183333; }
        header { background:var(--dark); color:white; padding:18px 28px; }
        header strong { font-size:22px; }
        nav { background:white; border-bottom:1px solid var(--line); padding:12px 28px; display:flex; gap:18px; flex-wrap:wrap; }
        nav a { color:var(--dark); text-decoration:none; font-weight:bold; }
        main { max-width:1200px; margin:24px auto; padding:0 18px; }
        .cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:14px; }
        .card, .panel { background:white; border:1px solid var(--line); border-radius:12px; padding:18px; margin-bottom:16px; }
        .metric { font-size:25px; font-weight:bold; color:var(--dark); margin-top:8px; }
        table { width:100%; border-collapse:collapse; background:white; }
        th,td { text-align:left; padding:11px; border-bottom:1px solid var(--line); vertical-align:top; }
        th { background:#e8f4f3; }
        input,select,textarea { width:100%; padding:10px; border:1px solid #bdcece; border-radius:7px; margin:5px 0 14px; }
        label { font-weight:bold; }
        .btn { display:inline-block; border:0; border-radius:7px; background:var(--teal); color:white; padding:10px 14px; text-decoration:none; cursor:pointer; }
        .btn.secondary { background:#e5eeee; color:var(--dark); }
        .row { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; }
        .alert { background:#e0f7ec; color:#14532d; padding:12px; border-radius:7px; margin-bottom:14px; }
        .error { color:#b91c1c; font-size:14px; }
        .muted { color:#657777; font-size:14px; }
        .actions { display:flex; gap:8px; flex-wrap:wrap; }
        @media print { nav,.no-print,header { display:none!important; } body { background:white; } main { margin:0; max-width:none; } .panel,.card { border:0; } }
    </style>
</head>
<body>
<header><strong>FundTrack</strong><div>CCJE Student Body Organization · Financial Monitoring</div></header>
<nav class="no-print">
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('events.index') }}">Events</a>
    <a href="{{ route('events.create') }}">+ Create Event</a>
</nav>
<main>
    @if(session('success')) <div class="alert">{{ session('success') }}</div> @endif
    @if($errors->any())
        <div class="alert" style="background:#fee2e2;color:#991b1b">
            Please check the form:
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>

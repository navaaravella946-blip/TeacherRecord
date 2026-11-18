<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Teacher Records') · {{ config('app.name', 'Teacher Records') }}</title>
    <link rel="stylesheet" href="{{ asset('css/teacher-records.css') }}">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">T</span>
                <span>Teach<span class="brand-light">erly</span></span>
            </a>
            <p class="sidebar-label">WORKSPACE</p>
            <a class="nav-link nav-link-active" href="{{ route('home') }}">
                <span class="nav-icon" aria-hidden="true">▦</span>
                Teacher directory
            </a>
            <div class="sidebar-note">
                <span class="note-sparkle" aria-hidden="true">✦</span>
                <p>Great schools start with great teachers.</p>
                <span class="note-caption">Your faculty, all in one place.</span>
            </div>
            <div class="sidebar-footer">
                <span class="school-avatar" aria-hidden="true">S</span>
                <span><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->email }}</small></span>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <span class="breadcrumb">Workspace <span aria-hidden="true">/</span> Teachers</span>
                <div style="display:flex;align-items:center;gap:14px">
                    <span class="workspace-pill"><span class="online-dot" aria-hidden="true"></span> Your school</span>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="text-action">Sign out</button></form>
                </div>
            </header>
            <div class="content-area">
                @yield('content')
            </div>
            <footer class="page-footer">Made for the people who make a difference.</footer>
        </main>
    </div>
</body>
</html>

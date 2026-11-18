<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in · {{ config('app.name', 'Teacher Records') }}</title>
    <link rel="stylesheet" href="{{ asset('css/teacher-records.css') }}">
    <style>
        body{min-height:100vh;display:grid;place-items:center;background:#f5f6fb;padding:24px}
        .login-card{width:min(100%,440px);background:#fff;border:1px solid #e8eaf2;border-radius:18px;padding:36px;box-shadow:0 18px 55px rgba(30,35,70,.08)}
        .login-card h1{margin:24px 0 8px;font-size:28px}.login-card p{color:#687087;margin:0 0 24px}
        .login-card label{display:block;font-weight:600;margin:16px 0 7px}.login-card input{width:100%;padding:12px 14px;border:1px solid #d9ddea;border-radius:9px;font:inherit}
        .login-card .button{width:100%;justify-content:center;margin-top:22px;border:0;cursor:pointer}.login-error{color:#b42318;background:#fff1f0;padding:10px 12px;border-radius:8px;margin:12px 0}
        .remember{display:flex;align-items:center;gap:8px;margin-top:14px}.remember label{margin:0;font-weight:400}.remember input{width:auto}
    </style>
</head>
<body>
    <main class="login-card">
        <a class="brand" href="{{ route('login') }}"><span class="brand-mark" aria-hidden="true">T</span><span>Teach<span class="brand-light">erly</span></span></a>
        <h1>Welcome back</h1>
        <p>Sign in to manage your school's teacher directory.</p>
        @if ($errors->any())
            <div class="login-error" role="alert">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">
            <div class="remember"><input id="remember" name="remember" type="checkbox" value="1"><label for="remember">Remember me</label></div>
            <button class="button button-primary" type="submit">Sign in</button>
        </form>
    </main>
</body>
</html>

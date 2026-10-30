<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Forgot password | {{ config('business.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0a2a33; --teal: #0e4a57; --mist: #eaf1f3; --paper: #fff;
            --sun: #ffc53d; --sun-deep: #e8a900; --line: #cfdde1; --muted: #4a6670;
            --display: "Bricolage Grotesque", "Segoe UI", system-ui, sans-serif;
            --body: "Hanken Grotesk", "Segoe UI", system-ui, sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; font-family: var(--body); color: var(--ink); background: var(--ink); display: flex; align-items: center; justify-content: center; padding: 1.25rem; -webkit-font-smoothing: antialiased; }
        :focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }
        .box { width: 100%; max-width: 24rem; }
        .brand { display: flex; align-items: center; justify-content: center; gap: .6rem; font: 800 1.5rem var(--display); color: #fff; text-decoration: none; margin-bottom: 1.4rem; letter-spacing: -.01em; }
        .brand svg { width: 2.2rem; height: 2.2rem; }
        .brand, .brand:visited, .brand:hover, .brand:focus { color: #fff !important; }
        .card { background: var(--paper); border-radius: 1.2rem; padding: 1.8rem; box-shadow: 0 1.5rem 3rem rgba(0,0,0,.35); }
        .back { display: inline-block; font-size: .9rem; font-weight: 600; color: var(--muted); text-decoration: none; margin-bottom: .8rem; }
        .back:hover { color: var(--ink); }
        h2 { margin: 0 0 .5rem; font: 800 1.8rem/1.1 var(--display); letter-spacing: -.02em; }
        .hint { margin: 0 0 1.1rem; color: var(--muted); font-size: .95rem; line-height: 1.5; }
        input[type=email] { width: 100%; padding: .7rem .85rem; margin-bottom: 1rem; border: 2px solid var(--line); border-radius: .6rem; font: 500 1rem var(--body); color: var(--ink); background: var(--paper); }
        input[type=email]:hover { border-color: #9fb6bd; }
        input[type=email]:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 3px rgba(255,197,61,.45); }
        button { width: 100%; padding: .8rem 1.4rem; background: var(--sun); color: var(--ink); border: 2px solid transparent; border-radius: .6rem; font: 600 1rem var(--body); cursor: pointer; }
        button:hover { background: var(--sun-deep); }
        .err { background: #fdecea; color: #8f1d14; border: 1px solid #f2c1bc; border-left: 5px solid #b42318; padding: .6rem .8rem; border-radius: .6rem; margin-bottom: .9rem; font-size: .92rem; font-weight: 500; }
        .ok { background: #e8f6f1; color: #14573f; border: 1px solid #b8e0d1; border-left: 5px solid #1f8a70; padding: .6rem .8rem; border-radius: .6rem; margin-bottom: .9rem; font-size: .92rem; font-weight: 500; }
    </style>
</head>
<body>
    <div class="box">
        <a class="brand" href="{{ url('/') }}">
            <svg viewBox="0 0 32 32" aria-hidden="true"><rect width="32" height="32" rx="8" fill="#ffc53d"/><path d="M8 8h6v6H8zM18 8h6v6h-6zM8 18h6v6H8z" fill="#0a2a33"/><circle cx="21" cy="21" r="3.2" fill="none" stroke="#0a2a33" stroke-width="2.4"/></svg>
            {{ config('business.name') }}
        </a>
        <div class="card">
            <a class="back" href="{{ route('login') }}">&larr; Back to login</a>
            <h2>Forgot password?</h2>
            <p class="hint">Enter your account email and we will send you a link to reset your password.</p>
            @if(session('status'))<div class="ok">{{ session('status') }}</div>@endif
            @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <button>Send reset link</button>
            </form>
        </div>
    </div>
</body>
</html>
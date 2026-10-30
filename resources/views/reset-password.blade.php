<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Reset password | {{ config('business.name') }}</title>
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
        h2 { margin: 0 0 1.1rem; font: 800 1.8rem/1.1 var(--display); letter-spacing: -.02em; }
        input[type=email], input[type=password] { width: 100%; padding: .7rem .85rem; margin-bottom: .8rem; border: 2px solid var(--line); border-radius: .6rem; font: 500 1rem var(--body); color: var(--ink); background: var(--paper); }
        input[type=email]:hover, input[type=password]:hover { border-color: #9fb6bd; }
        input[type=email]:focus, input[type=password]:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 3px rgba(255,197,61,.45); }
        input[readonly] { background: var(--mist); color: var(--muted); }
        button { width: 100%; margin-top: .3rem; padding: .8rem 1.4rem; background: var(--sun); color: var(--ink); border: 2px solid transparent; border-radius: .6rem; font: 600 1rem var(--body); cursor: pointer; }
        button:hover { background: var(--sun-deep); }
        .err { background: #fdecea; color: #8f1d14; border: 1px solid #f2c1bc; border-left: 5px solid #b42318; padding: .6rem .8rem; border-radius: .6rem; margin-bottom: .9rem; font-size: .92rem; font-weight: 500; }
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
            <h2>Set a new password</h2>
            @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="email" name="email" value="{{ old('email', $email) }}" placeholder="Email" required readonly>
                <input type="password" name="password" placeholder="New password (min 8 characters)" required minlength="8" autofocus autocomplete="new-password">
                <input type="password" name="password_confirmation" placeholder="Confirm new password" required minlength="8" autocomplete="new-password">
                <button>Reset password</button>
            </form>
        </div>
    </div>
</body>
</html>
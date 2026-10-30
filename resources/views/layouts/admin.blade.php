<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('business.name', 'Dynamic QR') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        /* ===== Shared theme (same as home page) ===== */
        :root {
            --ink: #0a2a33;
            --teal: #0e4a57;
            --mist: #eaf1f3;
            --paper: #ffffff;
            --sun: #ffc53d;
            --sun-deep: #e8a900;
            --leaf: #1f8a70;
            --line: #cfdde1;
            --muted: #4a6670;
            --danger: #b42318;
            --on-ink-muted: #b9ced4;
            --display: "Bricolage Grotesque", "Segoe UI", system-ui, sans-serif;
            --body: "Hanken Grotesk", "Segoe UI", system-ui, sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        body { margin: 0; font-family: var(--body); font-size: 1rem; line-height: 1.55; color: var(--ink); background: var(--mist);
               -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; }
        h1, h2, h3, p { margin: 0; }
        a { color: inherit; }
        :focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }
        .wrap { width: min(72rem, 100% - 2.5rem); margin-inline: auto; }
        .page { padding-block: 2rem 4rem; }
        .page-narrow { width: min(48rem, 100% - 2.5rem); margin-inline: auto; padding-block: 2rem 4rem; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: .4rem; font: 600 .95rem/1.2 var(--body); text-decoration: none;
               padding: .7rem 1.25rem; border-radius: .6rem; border: 2px solid transparent; cursor: pointer; white-space: nowrap;
               transition: background .15s, border-color .15s, color .15s; }
        .btn svg { width: 1rem; height: 1rem; flex-shrink: 0; }
        .btn-sun { background: var(--sun); color: var(--ink); }
        .btn-sun:hover { background: var(--sun-deep); }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--teal); }
        .btn-line { background: var(--paper); border-color: var(--ink); color: var(--ink); }
        .btn-line:hover { background: var(--ink); color: #fff; }
        .btn-ghost { border-color: rgba(255,255,255,.45); color: #fff; }
        .btn-ghost:hover { border-color: #fff; }
        .btn-danger { background: var(--paper); border-color: var(--danger); color: var(--danger); }
        .btn-danger:hover { background: var(--danger); color: #fff; }
        .btn-sm { padding: .45rem .9rem; font-size: .88rem; }
        .btn-block { width: 100%; }
        .btn-disabled { background: var(--mist); color: #8aa0a8; border-color: var(--line); pointer-events: none; }

        /* Page header */
        .page-head { background: var(--ink); color: #fff; border-radius: 1.2rem; padding: 1.6rem 1.8rem; margin-bottom: 1.4rem; }
        .page-head-row { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; }
        .page-title { font: 800 clamp(1.6rem, 4vw, 2.2rem)/1.1 var(--display); letter-spacing: -.02em; }
        .page-sub { margin-top: .35rem; color: var(--on-ink-muted); font-size: .98rem; }
        .count-pill { background: var(--sun); color: var(--ink); font-weight: 700; font-size: .9rem; padding: .4rem 1rem; border-radius: 999px; }
        .meta { display: flex; flex-wrap: wrap; align-items: center; gap: .5rem; margin-top: .6rem; }

        /* Panels */
        .panel { background: var(--paper); border: 1px solid var(--line); border-radius: 1rem; padding: 1.4rem; margin-bottom: 1.2rem; }
        .panel-head { display: flex; align-items: center; gap: .8rem; padding-bottom: 1rem; margin-bottom: 1.1rem; border-bottom: 2px solid var(--ink); }
        .panel-icon { width: 2.4rem; height: 2.4rem; border-radius: .6rem; background: var(--sun); color: var(--ink); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .panel-icon svg { width: 1.2rem; height: 1.2rem; }
        .panel-title { font: 700 1.2rem/1.2 var(--display); letter-spacing: -.01em; }
        .panel-sub { font-size: .9rem; color: var(--muted); margin-top: .1rem; }
        .stack > * + * { margin-top: 1rem; }

        /* Toolbars */
        .toolbar { background: var(--paper); border: 1px solid var(--line); border-radius: 1rem; padding: .9rem 1.1rem; margin-bottom: 1rem;
                   display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: .75rem; }
        .toolbar-start { justify-content: flex-start; }

        /* Forms */
        .label { display: block; font-size: .78rem; font-weight: 700; color: var(--teal); text-transform: uppercase; letter-spacing: .06em; margin-bottom: .35rem; }
        .hint { font-size: .85rem; color: var(--muted); margin-top: .3rem; }
        .input { border: 2px solid var(--line); border-radius: .6rem; padding: .6rem .85rem; font: 500 .95rem var(--body); background: var(--paper); color: var(--ink); transition: border-color .15s; }
        .input::placeholder { color: #7f959d; }
        .input:hover { border-color: #9fb6bd; }
        .input:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 3px rgba(255,197,61,.45); }
        .input-full { width: 100%; }
        .grid2 { display: grid; grid-template-columns: 1fr; gap: .75rem; }
        @media (min-width: 40rem) { .grid2 { grid-template-columns: 1fr 1.6fr; } }
        .inline-form { display: inline-flex; flex-wrap: wrap; gap: .5rem; align-items: center; }

        /* Alerts */
        .alert { padding: .8rem 1rem; margin-bottom: 1rem; border-radius: .7rem; font-size: .95rem; font-weight: 500; border: 1px solid; border-left-width: 5px; display: flex; align-items: center; gap: .55rem; }
        .alert svg { width: 1rem; height: 1rem; flex-shrink: 0; }
        .alert-ok { background: #e6f4ef; color: #14604c; border-color: #b7dccf; border-left-color: var(--leaf); }
        .alert-err { background: #fdecea; color: #8f1d14; border-color: #f2c1bc; border-left-color: var(--danger); }

        /* Chips / badges */
        .code { display: inline-block; background: var(--sun); color: var(--ink); font-family: ui-monospace, monospace; font-weight: 700; font-size: .85rem; padding: .15rem .65rem; border-radius: .5rem; }
        .code-soft { background: var(--mist); border: 1px solid var(--line); }
        .badge { display: inline-block; font-size: .75rem; font-weight: 700; padding: .15rem .7rem; border-radius: 999px; border: 2px solid; }
        .badge-single { color: var(--teal); border-color: var(--teal); background: transparent; }
        .badge-multi { color: #14604c; border-color: var(--leaf); background: #e6f4ef; }
        .badge-off { color: var(--danger); border-color: var(--danger); background: #fdecea; }
        .pill { background: var(--ink); color: #fff; font-size: .75rem; font-weight: 700; padding: .1rem .65rem; border-radius: 999px; margin-left: .4rem; vertical-align: middle; }

        /* Table */
        .table-card { background: var(--paper); border: 1px solid var(--line); border-radius: 1rem; overflow: hidden; }
        .table-scroll { overflow-x: auto; }
        .tbl { width: 100%; border-collapse: collapse; font-size: .95rem; }
        .tbl thead tr { background: var(--ink); }
        .tbl th { padding: .85rem .9rem; font-size: .75rem; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: .07em; text-align: left; }
        .tbl tbody tr { border-bottom: 1px solid var(--line); }
        .tbl tbody tr:nth-child(even) { background: #f6fafb; }
        .tbl tbody tr:last-child { border-bottom: 0; }
        .tbl tbody tr:hover { background: #eef5f7; }
        .tbl td { padding: .75rem .9rem; vertical-align: middle; }
        .row-on td:first-child { box-shadow: inset 4px 0 0 var(--leaf); }
        .row-off td:first-child { box-shadow: inset 4px 0 0 #9fb6bd; }
        .row-off .code { opacity: .55; }
        .row-form { display: flex; flex-wrap: wrap; gap: .6rem; align-items: center; min-width: 38rem; }
        .row-form .f-name { width: 10rem; }
        .row-form .f-url { flex: 1; min-width: 12rem; }
        .row-form .f-owner { width: 9rem; }
        .check-label { display: inline-flex; align-items: center; gap: .4rem; cursor: pointer; font-size: .9rem; font-weight: 600; padding: .4rem .75rem; border-radius: 999px; border: 2px solid var(--line); background: var(--paper); }
        .check-label:hover { border-color: var(--teal); }
        .check-label input { accent-color: var(--leaf); width: 1rem; height: 1rem; }
        .scans { display: inline-block; min-width: 2.6rem; text-align: center; background: var(--mist); font-weight: 700; padding: .2rem .65rem; border-radius: 999px; border: 1px solid var(--line); }
        .row-actions { white-space: nowrap; display: flex; gap: .5rem; }
        .empty { padding: 2.5rem 1rem; text-align: center; color: var(--muted); }
        .pager { display: flex; align-items: center; justify-content: center; gap: .9rem; margin: 1.4rem 0 .5rem; font-size: .9rem; color: var(--muted); }
        .pager-info { background: var(--paper); border: 1px solid var(--line); padding: .4rem 1rem; border-radius: 999px; font-weight: 600; color: var(--ink); }

        /* Link rows (edit page) */
        .link-row { display: flex; align-items: center; gap: .85rem; padding: .85rem .5rem; border-bottom: 1px solid var(--line); flex-wrap: wrap; }
        .link-row:last-child { border-bottom: 0; }
        .link-avatar { width: 2.5rem; height: 2.5rem; border-radius: 50%; background: var(--ink); color: var(--sun); font: 800 1.05rem var(--display); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .link-main { flex: 1; min-width: 0; }
        .link-title { font-weight: 700; }
        .link-url { font-size: .82rem; color: var(--muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .clicks { background: var(--mist); border: 1px solid var(--line); font-size: .82rem; font-weight: 700; padding: .25rem .8rem; border-radius: 999px; white-space: nowrap; }
        .empty-box { text-align: center; color: var(--muted); padding: 1.8rem 0; background: var(--mist); border: 2px dashed var(--line); border-radius: .9rem; }
        .view-box { background: var(--paper); border: 1px solid var(--line); border-radius: 1rem; padding: 1rem 1.2rem; display: flex; flex-wrap: wrap; align-items: center; gap: .6rem; font-size: .95rem; }
        .view-box strong { font-size: .78rem; text-transform: uppercase; letter-spacing: .06em; color: var(--teal); }
        .view-box a { font-weight: 600; word-break: break-all; color: var(--teal); }
        .view-box .btn { margin-left: auto; }
        .back { display: inline-flex; align-items: center; gap: .4rem; font-weight: 600; font-size: .92rem; text-decoration: none; padding: .45rem 1rem; border-radius: 999px; background: var(--paper); border: 2px solid var(--line); margin-bottom: 1.1rem; }
        .back:hover { border-color: var(--ink); }
        .back svg { width: 1rem; height: 1rem; }

        /* Standee cards (user dashboard) */
        .cards { display: grid; gap: 1rem; grid-template-columns: 1fr; }
        @media (min-width: 44rem) { .cards { grid-template-columns: 1fr 1fr; } }
        .card-item { background: var(--paper); border: 1px solid var(--line); border-top: 4px solid var(--sun); border-radius: 1rem; padding: 1.2rem; }
        .card-name { font: 700 1.15rem/1.25 var(--display); display: flex; flex-wrap: wrap; align-items: center; gap: .4rem; }
        .stats { display: flex; gap: .6rem; margin: 1rem 0; }
        .stat { flex: 1; background: var(--mist); border-radius: .7rem; padding: .6rem; text-align: center; }
        .stat b { display: block; font: 800 1.5rem var(--display); }
        .stat span { font-size: .8rem; color: var(--muted); font-weight: 600; }
        .card-actions { display: flex; flex-wrap: wrap; gap: .5rem; }

        /* Top navigation */
        .topbar { position: sticky; top: 0; z-index: 50; background: var(--ink); color: #fff; }
        .bar { display: flex; align-items: center; justify-content: space-between; gap: 1rem; min-height: 4rem; }
        .bar-left, .bar-right { display: flex; align-items: center; gap: .4rem; }
        .bar-right { gap: .75rem; }
        .brand { display: flex; align-items: center; gap: .6rem; font: 800 1.3rem var(--display); text-decoration: none; letter-spacing: -.01em; margin-right: 1rem; color: #fff; }
        .brand svg { width: 2rem; height: 2rem; }
        .brand, .brand:visited, .brand:hover, .brand:focus, .brand .brand-text { color: #fff !important; }
        .nav-link { padding: .5rem .9rem; border-radius: .5rem; text-decoration: none; font-weight: 600; font-size: .95rem; color: var(--on-ink-muted); transition: background .15s, color .15s; }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.08); }
        .nav-link.is-active { color: var(--ink); background: var(--sun); }
        .nav-user { display: flex; align-items: center; gap: .55rem; padding: .25rem .8rem .25rem .3rem; border: 1px solid rgba(255,255,255,.2); border-radius: 999px; }
        .nav-avatar { width: 1.9rem; height: 1.9rem; border-radius: 50%; background: var(--sun); color: var(--ink); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: .85rem; }
        .nav-name { font-size: .88rem; font-weight: 600; line-height: 1.1; }
        .nav-role { display: inline-block; margin-top: .1rem; font-size: .65rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase; padding: .05rem .5rem; border-radius: 999px; }
        .nav-role.admin { background: var(--sun); color: var(--ink); }
        .nav-role.user { background: rgba(255,255,255,.14); color: #fff; }

        @media (max-width: 40rem) {
            .brand-text, .nav-user .nav-text, .logout-text { display: none; }
            .brand { margin-right: .3rem; }
            .nav-link { padding: .4rem .6rem; font-size: .85rem; }
            .nav-user { padding: .2rem; }
            .page-head { padding: 1.2rem; }
        }
    </style>
</head>
<body>
    @php
        $navUser = auth()->user();
        $navInitial = strtoupper(mb_substr($navUser->name, 0, 1));
    @endphp

    <nav class="topbar">
        <div class="wrap bar">
            <div class="bar-left">
                <a href="{{ route('standees.index') }}" class="brand" aria-label="{{ config('business.name', 'Dynamic QR') }}">
                    <svg viewBox="0 0 32 32" aria-hidden="true"><rect width="32" height="32" rx="8" fill="#ffc53d"/><path d="M8 8h6v6H8zM18 8h6v6h-6zM8 18h6v6H8z" fill="#0a2a33"/><circle cx="21" cy="21" r="3.2" fill="none" stroke="#0a2a33" stroke-width="2.4"/></svg>
                    <span class="brand-text">{{ config('business.name', 'Dynamic QR') }}</span>
                </a>

                <a href="{{ route('standees.index') }}"
                   class="nav-link {{ request()->routeIs('standees.*') ? 'is-active' : '' }}">
                    {{ $navUser->is_admin ? 'All Standees' : 'My Standees' }}
                </a>

                @if($navUser->is_admin)
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ request()->routeIs('users.*') ? 'is-active' : '' }}">
                        Users
                    </a>
                @endif
            </div>

            <div class="bar-right">
                <div class="nav-user">
                    <span class="nav-avatar">{{ $navInitial }}</span>
                    <span class="nav-text">
                        <div class="nav-name">{{ $navUser->name }}</div>
                        <span class="nav-role {{ $navUser->is_admin ? 'admin' : 'user' }}">{{ $navUser->is_admin ? 'Admin' : 'User' }}</span>
                    </span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/>
                        </svg>
                        <span class="logout-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
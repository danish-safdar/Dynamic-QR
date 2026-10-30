<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
    <meta name="theme-color" content="#0a2a33">
    <title>{{ $standee->page_title ?: $standee->name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0a2a33;
            --teal: #0e4a57;
            --mist: #eaf1f3;
            --paper: #ffffff;
            --sun: #ffc53d;
            --line: #cfdde1;
            --muted: #4a6670;
            --on-ink-muted: #b9ced4;
            --display: "Bricolage Grotesque", "Segoe UI", system-ui, sans-serif;
            --body: "Hanken Grotesk", "Segoe UI", system-ui, sans-serif;
        }
        * { box-sizing: border-box; }
        html { -webkit-text-size-adjust: 100%; }
        body { margin: 0; min-height: 100vh; font-family: var(--body); color: #fff; background: var(--ink); -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; }
        :focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }

        .wrap { max-width: 440px; margin: 0 auto; padding: 56px 20px 48px; text-align: center; }

        .avatar { width: 92px; height: 92px; margin: 0 auto 20px; border-radius: 50%; background: var(--sun); padding: 4px; animation: pop .6s cubic-bezier(.2,.9,.3,1.2) both; }
        .avatar span { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; border-radius: 50%; background: var(--ink); font: 800 38px var(--display); color: var(--sun); }

        h1 { font: 800 28px/1.15 var(--display); letter-spacing: -.02em; margin: 0 0 8px; animation: rise .5s .08s both; }
        .sub { margin: 0 auto 6px; max-width: 340px; font-size: 16px; line-height: 1.55; color: var(--on-ink-muted); animation: rise .5s .14s both; }
        .divider { width: 56px; height: 4px; border-radius: 4px; margin: 22px auto 26px; background: var(--sun); animation: rise .5s .2s both; }

        .links { display: flex; flex-direction: column; gap: 12px; }
        .btn { --c: var(--sun); position: relative; display: flex; align-items: center; gap: 14px; text-align: left; text-decoration: none; color: var(--ink);
               padding: 12px 14px; border-radius: 14px; background: var(--paper); border: 2px solid transparent;
               animation: rise .5s calc(.26s + var(--i) * .07s) both; transition: transform .15s, background .15s, border-color .15s; -webkit-tap-highlight-color: transparent; }
        .btn:hover { transform: translateY(-2px); border-color: var(--sun); }
        .btn:active { transform: scale(.98); }

        .chip { width: 44px; height: 44px; flex-shrink: 0; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--ink); background: var(--sun); }
        .chip svg { width: 22px; height: 22px; }
        .label { flex: 1; min-width: 0; font-size: 16px; font-weight: 700; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .arrow { width: 20px; height: 20px; flex-shrink: 0; color: var(--teal); transition: transform .2s; }
        .btn:hover .arrow { transform: translateX(3px); }

        @keyframes rise { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
        @keyframes pop  { from { opacity: 0; transform: scale(.7); } to { opacity: 1; transform: none; } }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } }
    </style>
</head>
<body>
@php
    $heading = $standee->page_title ?: $standee->name;

    // Icon paths (24x24, stroke style)
    $icons = [
        'chat'      => '<path d="M21 11.5a8.4 8.4 0 0 1-12.4 7.4L3 21l2.1-5.6A8.4 8.4 0 1 1 21 11.5z"/>',
        'phone'     => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/>',
        'mail'      => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'pin'       => '<path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
        'globe'     => '<circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/>',
        'instagram' => '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/>',
        'facebook'  => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>',
        'youtube'   => '<path d="M22 8.5a3 3 0 0 0-2.1-2.1C18 6 12 6 12 6s-6 0-7.9.4A3 3 0 0 0 2 8.5 31 31 0 0 0 1.6 12 31 31 0 0 0 2 15.5a3 3 0 0 0 2.1 2.1C6 18 12 18 12 18s6 0 7.9-.4a3 3 0 0 0 2.1-2.1A31 31 0 0 0 22.4 12 31 31 0 0 0 22 8.5z"/><path d="m10 15 5-3-5-3z"/>',
        'tiktok'    => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
        'link'      => '<path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/>',
    ];

    // Pick an icon from the button title / url
    $pick = function ($title, $url) {
        $h = strtolower($title . ' ' . $url);
        return match (true) {
            str_contains($h, 'whatsapp') || str_contains($h, 'wa.me')                  => 'chat',
            str_contains($h, 'instagram')                                              => 'instagram',
            str_contains($h, 'facebook') || str_contains($h, 'fb.com')                 => 'facebook',
            str_contains($h, 'youtube') || str_contains($h, 'youtu.be')                => 'youtube',
            str_contains($h, 'tiktok')                                                 => 'tiktok',
            str_contains($h, 'call') || str_contains($h, 'phone') || str_contains($h, 'contact') => 'phone',
            str_contains($h, 'mail')                                                   => 'mail',
            str_contains($h, 'map') || str_contains($h, 'location') || str_contains($h, 'direction') || str_contains($h, 'address') => 'pin',
            str_contains($h, 'web') || str_contains($h, 'site')                        => 'globe',
            default                                                                    => 'link',
        };
    };
@endphp

    <div class="wrap">
        <div class="avatar"><span>{{ strtoupper(mb_substr($heading, 0, 1)) }}</span></div>

        <h1>{{ $heading }}</h1>
        @if($standee->page_subtitle)
            <p class="sub">{{ $standee->page_subtitle }}</p>
        @endif

        <div class="divider"></div>

        <div class="links">
            @foreach($links as $link)
                @php $key = $pick($link->title, $link->url); @endphp
                <a class="btn" href="{{ route('link.click', $link) }}" style="--i: {{ $loop->index }}">
                    <span class="chip">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $icons[$key] !!}</svg>
                    </span>
                    <span class="label">{{ $link->title }}</span>
                    <svg class="arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                </a>
            @endforeach
        </div>
    </div>
</body>
</html>
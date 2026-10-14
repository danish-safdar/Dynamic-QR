<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $standee->page_title ?: $standee->name }}</title>
    <style>
        body { margin:0; font-family: system-ui, sans-serif; background:#f3f4f6; }
        .wrap { max-width:420px; margin:0 auto; padding:40px 20px; text-align:center; }
        h1 { font-size:24px; margin:0 0 8px; color:#111827; }
        p { margin:0 0 28px; color:#6b7280; }
        a.btn { display:block; background:#111827; color:#fff; text-decoration:none;
                padding:14px 16px; border-radius:12px; margin-bottom:12px; font-size:16px; }
        a.btn:active { opacity:.8; }
    </style>
</head>
<body>
    <div class="wrap">
        <h1>{{ $standee->page_title ?: $standee->name }}</h1>
        @if($standee->page_subtitle)
            <p>{{ $standee->page_subtitle }}</p>
        @endif

        @foreach($links as $link)
            <a class="btn" href="{{ route('link.click', $link) }}">{{ $link->title }}</a>
        @endforeach
    </div>
</body>
</html>
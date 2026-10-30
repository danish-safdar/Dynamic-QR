<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

<title>NFC Google Review Standee with QR Code | TapReach</title>
<meta name="description" content="Get more Google reviews with TapReach NFC and QR review standees. Easy tap-and-scan acrylic stands for shops, restaurants, salons and other businesses.">
<link rel="canonical" href="https://tapreach.pk/">
<link rel="icon" href="/favicon.ico" sizes="48x48">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
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
            --on-ink-muted: #b9ced4;
            --nav-h: 4.25rem;
            --display: "Bricolage Grotesque", "Segoe UI", system-ui, sans-serif;
            --body: "Hanken Grotesk", "Segoe UI", system-ui, sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; }
        /* scroll-padding-top: anchor links sticky navbar ke neeche na chhupein */
        html { scroll-behavior: smooth; scroll-padding-top: var(--nav-h); }
        body { margin: 0; font-family: var(--body); font-size: 1.0625rem; line-height: 1.6; color: var(--ink); background: var(--paper); overflow-x: hidden; overflow-x: clip; }
        h1, h2, h3, p { margin: 0; }
        a { color: inherit; }
        :focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }
        .wrap { width: min(72rem, 100% - 2.5rem); margin-inline: auto; }

        /* buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; font: 600 1rem var(--body); text-decoration: none; padding: .8rem 1.4rem; border-radius: .6rem; border: 2px solid transparent; cursor: pointer; }
        .btn-sun { background: var(--sun); color: var(--ink); }
        .btn-sun:hover { background: var(--sun-deep); }
        .btn-line { border-color: rgba(255,255,255,.45); color: #fff; }
        .btn-line:hover { border-color: #fff; }
        .btn-dark { background: var(--ink); color: #fff; }
        .btn-dark:hover { background: var(--teal); }

        /* sticky navbar */
        .nav { position: sticky; top: 0; z-index: 1000; background: var(--ink); color: #fff; border-bottom: 1px solid rgba(255,255,255,.08); transition: box-shadow .25s ease; }
        .nav.is-scrolled { box-shadow: 0 .6rem 1.4rem -.6rem rgba(0,0,0,.45); }
        .nav-bar { display: flex; align-items: center; justify-content: space-between; min-height: var(--nav-h); }
        .brand { display: flex; align-items: center; gap: .6rem; font: 800 1.4rem var(--display); text-decoration: none; letter-spacing: -.01em; }
        .brand svg { width: 2rem; height: 2rem; }
        .brand, .brand:visited, .brand:hover, .brand:focus { color: #fff !important; }

        .nav-toggle { display: none; width: 2.8rem; height: 2.8rem; padding: 0; border: 2px solid rgba(255,255,255,.35); border-radius: .6rem; background: transparent; cursor: pointer; position: relative; }
        .nav-toggle span { position: absolute; left: .65rem; right: .65rem; height: 2px; background: #fff; border-radius: 2px; transition: transform .25s ease, opacity .2s ease, top .25s ease; }
        .nav-toggle span:nth-child(1) { top: .85rem; }
        .nav-toggle span:nth-child(2) { top: 1.2rem; }
        .nav-toggle span:nth-child(3) { top: 1.55rem; }
        .nav-toggle[aria-expanded="true"] span:nth-child(1) { top: 1.2rem; transform: rotate(45deg); }
        .nav-toggle[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
        .nav-toggle[aria-expanded="true"] span:nth-child(3) { top: 1.2rem; transform: rotate(-45deg); }

        .nav-menu { display: flex; align-items: center; gap: 1.6rem; }
        .nav-links { display: flex; align-items: center; gap: .3rem; list-style: none; margin: 0; padding: 0; }
        .nav-link { display: block; position: relative; padding: .5rem .8rem; font-weight: 600; font-size: .98rem; text-decoration: none; color: var(--on-ink-muted); border-radius: .5rem; }
        .nav-link:hover, .nav-link[aria-current="true"] { color: #fff; }
        .nav-link[aria-current="true"]::after { content: ""; position: absolute; left: .8rem; right: .8rem; bottom: .1rem; height: 3px; border-radius: 3px; background: var(--sun); }
        .nav-cta { padding: .6rem 1.1rem; }

        @media (max-width: 55rem) {
            .nav-toggle { display: block; }
            .nav-menu { display: none; position: absolute; top: 100%; left: 0; right: 0; flex-direction: column; align-items: stretch; gap: 1rem; padding: 1rem 1.25rem 1.4rem; background: var(--ink); border-bottom: 1px solid rgba(255,255,255,.08); box-shadow: 0 1rem 1.6rem -.6rem rgba(0,0,0,.5); }
            .nav-menu.is-open { display: flex; }
            .nav-links { flex-direction: column; align-items: stretch; gap: 0; }
            .nav-link { padding: .85rem .4rem; font-size: 1.05rem; border-bottom: 1px solid rgba(255,255,255,.08); border-radius: 0; }
            .nav-link[aria-current="true"]::after { left: .4rem; right: auto; width: 2rem; bottom: 0; }
            .nav-cta { width: 100%; }
        }

        /* hero */
        .hero { background: var(--ink); color: #fff; }
        .hero-grid { display: grid; gap: 3rem; padding-block: 3rem 5rem; align-items: center; }
        @media (min-width: 60rem) { .hero-grid { grid-template-columns: 1.15fr .85fr; padding-block: 4.5rem 6.5rem; } }
        h1 { font: 800 clamp(2.4rem, 6vw, 4.1rem)/1.04 var(--display); letter-spacing: -.025em; max-width: 14ch; }
        .lead { margin-top: 1.4rem; max-width: 34rem; color: var(--on-ink-muted); font-size: 1.15rem; }
        .cta { display: flex; flex-wrap: wrap; gap: .8rem; margin-top: 2rem; }

        /* hero QR card (pieces fly in and assemble) */
        .demo { background: var(--paper); border-radius: 1.4rem; padding: 1.4rem; width: min(100%, 20rem); justify-self: center; box-shadow: 0 1.5rem 3rem rgba(0,0,0,.35); }
        .qr { position: relative; width: 100%; aspect-ratio: 1 / 1; }
        .qr > svg { display: block; width: 100%; height: auto; }
        .qr-tiles { position: absolute; inset: 0; display: none; grid-template-columns: repeat(var(--n), 1fr); grid-template-rows: repeat(var(--n), 1fr); }
        .qr.is-assembling > svg { visibility: hidden; }
        .qr.is-assembling .qr-tiles { display: grid; }
        .qr-tile { position: relative; overflow: hidden; will-change: transform, opacity; }
        .qr-tile-inner { position: absolute; width: calc(var(--n) * 100%); height: calc(var(--n) * 100%); }
        .qr-tile-inner svg { display: block; width: 100%; height: 100%; }

        /* sections */
        section { padding-block: 4.5rem; }
        h2 { font: 800 clamp(1.8rem, 4vw, 2.6rem)/1.1 var(--display); letter-spacing: -.02em; max-width: 20ch; }
        .sub { margin-top: .9rem; color: var(--muted); max-width: 36rem; }

        .strip { background: var(--sun); color: var(--ink); padding-block: 1rem; overflow: hidden; }
        .strip .wrap { display: flex; flex-wrap: wrap; gap: .6rem 2.4rem; justify-content: center; font: 800 1.3rem var(--display); letter-spacing: .01em; }

        .why { background: var(--mist); }
        .svc-list { display: grid; gap: 0 3rem; margin-top: 2.6rem; }
        @media (min-width: 48rem) { .svc-list { grid-template-columns: 1fr 1fr; } }
        .svc { padding-block: 1.5rem; border-top: 2px solid var(--ink); }
        .svc h3 { font: 700 1.3rem/1.2 var(--display); letter-spacing: -.01em; }
        .svc p { margin-top: .5rem; color: var(--muted); max-width: 30rem; }
        .tagline { margin-top: 2.4rem; font: 800 clamp(1.4rem, 3vw, 2rem)/1.15 var(--display); letter-spacing: -.015em; }

        .product-grid { display: grid; gap: 2.5rem; margin-top: 2.6rem; align-items: center; }
        @media (min-width: 52rem) { .product-grid { grid-template-columns: 1.15fr .85fr; gap: 3.5rem; } }
        .product h3 { font: 800 clamp(1.6rem, 3.4vw, 2.2rem)/1.1 var(--display); letter-spacing: -.02em; }
        .product p { margin-top: .8rem; color: var(--muted); max-width: 32rem; }
        .tags { display: flex; flex-wrap: wrap; gap: .5rem; margin-top: 1.2rem; list-style: none; padding: 0; }
        .tags li { font-weight: 600; font-size: .9rem; padding: .3rem .8rem; border: 2px solid var(--line); border-radius: 999px; }
        .price { margin-top: 1.4rem; font: 800 1.8rem var(--display); }

        /* standee photos */
        .stands { background: var(--mist); border-radius: 1.4rem; padding: 1.6rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; align-items: start; }
        @media (max-width: 30rem) { .stands { grid-template-columns: 1fr; } }
        .standee { margin: 0; border-radius: 1rem; overflow: hidden; background: #fff; box-shadow: 0 1rem 2rem -.6rem rgba(10,42,51,.35); transition: transform .35s ease, box-shadow .35s ease; }
        .standee img { display: block; width: 100%; height: auto; }
        @media (min-width: 30.01rem) { .standee + .standee { margin-top: 2.2rem; } }
        @media (hover: hover) { .standee:hover { transform: translateY(-6px); box-shadow: 0 1.4rem 2.4rem -.6rem rgba(10,42,51,.45); } }
        .stand-label { text-align: center; margin-top: .9rem; font-size: .9rem; font-weight: 600; color: var(--muted); }

        .steps { display: grid; gap: 2rem; margin-top: 2.6rem; counter-reset: s; }
        @media (min-width: 48rem) { .steps { grid-template-columns: repeat(4, 1fr); gap: 2rem; } }
        .step { position: relative; padding-top: 3.4rem; }
        .step::before { counter-increment: s; content: counter(s); position: absolute; top: 0; left: 0; width: 2.5rem; height: 2.5rem; border-radius: 50%; background: var(--sun); color: var(--ink); font: 800 1.2rem/2.5rem var(--display); text-align: center; }
        @media (min-width: 48rem) { .step:not(:last-child)::after { content: ""; position: absolute; top: 1.2rem; left: 3.2rem; right: -1rem; border-top: 2px dashed var(--line); } }
        .step h3 { font: 700 1.2rem/1.25 var(--display); }
        .step p { margin-top: .4rem; color: var(--muted); }

        .contact { background: var(--teal); color: #fff; }
        .contact h2 { max-width: 18ch; }
        .contact .sub { color: var(--on-ink-muted); }

        footer { background: var(--ink); color: var(--on-ink-muted); padding-block: 1.6rem; font-size: .95rem; }
footer .wrap { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; align-items: center; text-align: center; }

        /* floating whatsapp button */
        .whatsapp-float { position: fixed; width: 62px; height: 62px; bottom: 25px; right: 25px; background: #25D366; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,.25); z-index: 9999; text-decoration: none; transition: all .3s ease; }
        .whatsapp-float:hover { background: #128C7E; transform: scale(1.1); color: #fff; box-shadow: 0 6px 20px rgba(0,0,0,.3); }
        .whatsapp-float svg { width: 36px; height: 36px; fill: currentColor; }
        @media (max-width: 600px) {
            .whatsapp-float { width: 55px; height: 55px; bottom: 18px; right: 18px; }
            .whatsapp-float svg { width: 32px; height: 32px; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .nav, .nav-toggle span { transition: none; }
        }
    </style>
</head>
<body>

@php
    $standeeQr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(300)->margin(0)->generate(rtrim(config('app.url'), '/'));

    $whatsappNumber = preg_replace('/\D/', '', config('business.whatsapp', ''));
    $whatsappMessage = urlencode('Hi, I am interested in your TapReach standee. Please share details.');
    $whatsappLink = 'https://wa.me/' . $whatsappNumber . '?text=' . $whatsappMessage;
@endphp

{{-- Sticky navbar --}}
<nav class="nav" id="site-nav" aria-label="Main navigation">
    <div class="wrap nav-bar">
        <a class="brand" href="#home" aria-label="{{ config('business.name') }} home">
            <svg viewBox="0 0 32 32" aria-hidden="true"><rect width="32" height="32" rx="8" fill="#ffc53d"/><path d="M8 8h6v6H8zM18 8h6v6h-6zM8 18h6v6H8z" fill="#0a2a33"/><circle cx="21" cy="21" r="3.2" fill="none" stroke="#0a2a33" stroke-width="2.4"/></svg>
            {{ config('business.name') }}
        </a>

        <button class="nav-toggle" id="nav-toggle" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="nav-menu">
            <span></span><span></span><span></span>
        </button>

        <div class="nav-menu" id="nav-menu">
            <ul class="nav-links">
                <li><a class="nav-link" href="#home">Home</a></li>
                <li><a class="nav-link" href="#why">About</a></li>
                <li><a class="nav-link" href="#standee">Standee</a></li>
                <li><a class="nav-link" href="#process">How it works</a></li>
                <li><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            @auth
                <a class="btn btn-sun nav-cta" href="{{ route('standees.index') }}">Open dashboard</a>
            @else
                <a class="btn btn-sun nav-cta" href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </div>
</nav>

<header class="hero" id="home">
    <div class="wrap">
        <div class="hero-grid">
            <div>
                <h1>NFC Google Review Standees with QR Code for Businesses</h1>
                <p class="lead">Premium NFC &amp; QR enabled stands, built to turn every tap into a five-star Google review.</p>
                <div class="cta">
                    @if($whatsappNumber)
                        <a class="btn btn-sun" href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer">Order your stand</a>
                    @endif
                    <a class="btn btn-line" href="#standee">See the standee</a>
                </div>
            </div>

            <div class="demo" aria-label="{{ config('business.name') }} QR code">
                <div class="qr" id="hero-qr">{!! $standeeQr !!}</div>
            </div>
        </div>
    </div>
</header>

<div class="strip" aria-hidden="true">
    <div class="wrap"><span>Tap</span><span>Scan</span><span>Review</span><span>Repeat</span></div>
</div>

<section class="why" id="why">
    <div class="wrap">
        <h2>One object. Every review.</h2>
        <p class="sub">The {{ config('business.name') }} stand sits on your counter and does one job: it sends your customer straight to your review page.</p>

        <div class="svc-list">
            <div class="svc">
                <h3>NFC chip, zero friction</h3>
                <p>A sealed NFC chip sits inside every stand. Customers simply tap their phone, with no app, no typing and no searching for your business name.</p>
            </div>
            <div class="svc">
                <h3>QR, for every phone</h3>
                <p>Older phone with no NFC? The printed QR code does the same job in one scan, straight to your Google review page.</p>
            </div>
            <div class="svc">
                <h3>Straight to five stars</h3>
                <p>No extra clicks, no dead links. The tap or scan opens your review box directly, so fewer people drop off between intending to review and doing it.</p>
            </div>
            <div class="svc">
                <h3>Premium, on any counter</h3>
                <p>Matte acrylic, a self-standing base and retina-sharp print, designed to look like part of your brand and not a sticker on the till.</p>
            </div>
        </div>

        <p class="tagline">One tap. One review. Zero friction.</p>
    </div>
</section>

<section id="standee">
    <div class="wrap">
        <h2>The counter standee</h2>

        <div class="product-grid">
            <div>
                <div class="stands">
                    <figure class="standee">
                        <img src="{{ asset('storage/S1.jpeg') }}" width="800" height="1200" loading="lazy" decoding="async"
                             alt="White {{ config('business.name') }} acrylic standee with an NFC tap area, a QR code and five stars: Rate your experience">
                    </figure>
                    <figure class="standee">
                        <img src="{{ asset('storage/S2.jpeg') }}" width="800" height="1200" loading="lazy" decoding="async"
                             alt="Black and gold {{ config('business.name') }} acrylic standee with an NFC tap area, a QR code and five stars: Rate your experience">
                    </figure>
                </div>
                <p class="stand-label">Powered by {{ config('business.name') }}</p>
            </div>

            <div class="product">
                <h3>Made for reception desks, checkout counters and tables</h3>
                <p>NFC and QR combined on a premium acrylic stand that stays put.</p>
                <ul class="tags">
                    <li>NFC embedded</li>
                    <li>QR printed</li>
                    <li>Self-standing</li>
                    <li>Black or white</li>
                </ul>
                @if(config('business.standee_price'))
                    <p class="price">{{ config('business.standee_price') }}</p>
                @endif
                <div class="cta">
                    @if($whatsappNumber)
                        <a class="btn btn-dark" href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer">Order on WhatsApp</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section id="process" style="padding-top:0">
    <div class="wrap">
        <h2>Order to reviews, in days</h2>
        <div class="steps">
            <div class="step">
                <h3>Order</h3>
                <p>Pick your standee and send us your Google review link.</p>
            </div>
            <div class="step">
                <h3>We program it</h3>
                <p>Your NFC chip is written and your QR is generated, both pointed at your review page.</p>
            </div>
            <div class="step">
                <h3>It ships</h3>
                <p>Your stand arrives ready to place, with no setup, no app and no extra hardware.</p>
            </div>
            <div class="step">
                <h3>Reviews roll in</h3>
                <p>Every tap or scan sends a customer straight to leave a review, day after day.</p>
            </div>
        </div>
    </div>
</section>

<section class="contact" id="contact">
    <div class="wrap">
        <h2>Give every customer a reason to tap.</h2>
        <div class="cta">
            @if($whatsappNumber)
                <a class="btn btn-sun" href="{{ $whatsappLink }}" target="_blank" rel="noopener noreferrer">Order your stand</a>
            @endif
            @if(config('business.email'))
                <a class="btn btn-line" href="mailto:{{ config('business.email') }}">Send an email</a>
            @endif
        </div>
    </div>
</section>

<footer>
    <div class="wrap">
        <span>&copy; {{ date('Y') }} <strong style="color:#fff">{{ config('business.name') }}</strong>. All rights reserved.</span>
    </div>
</footer>

{{-- Floating WhatsApp Button --}}
@if($whatsappNumber)
    <a href="{{ $whatsappLink }}" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Contact us on WhatsApp" title="Chat with us on WhatsApp">
        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M16.01 3C8.84 3 3 8.82 3 15.97c0 2.29.6 4.52 1.74 6.48L3 29l6.73-1.76a13.1 13.1 0 0 0 6.27 1.59h.01C23.17 28.83 29 23 29 15.86 29 8.72 23.17 3 16.01 3zm0 23.65c-1.95 0-3.86-.52-5.53-1.52l-.4-.24-4 .99 1.04-3.9-.26-.41a10.78 10.78 0 0 1-1.66-5.77c0-5.97 4.87-10.83 10.84-10.83 2.89 0 5.61 1.13 7.65 3.18a10.75 10.75 0 0 1 3.17 7.66c0 5.98-4.87 10.84-10.85 10.84zm5.95-8.12c-.33-.17-1.95-.96-2.25-1.07-.3-.11-.52-.17-.74.17-.22.33-.85 1.07-1.04 1.29-.19.22-.39.25-.72.08-.33-.17-1.39-.51-2.65-1.63-.98-.87-1.64-1.94-1.83-2.27-.19-.33-.02-.51.14-.68.15-.14.33-.39.5-.58.17-.19.22-.33.33-.55.11-.22.06-.41-.03-.58-.08-.17-.74-1.79-1.02-2.45-.27-.64-.54-.55-.74-.56h-.63c-.22 0-.58.08-.88.41-.3.33-1.15 1.13-1.15 2.75s1.18 3.19 1.34 3.41c.17.22 2.33 3.56 5.65 4.99.79.34 1.4.55 1.88.7.79.25 1.51.21 2.08.13.63-.09 1.95-.8 2.23-1.57.28-.77.28-1.43.19-1.57-.08-.14-.3-.22-.63-.39z"/>
        </svg>
    </a>
@endif

<script>
    // Navbar: mobile menu, scroll shadow, active link highlight
    (function () {
        var nav = document.getElementById('site-nav');
        var toggle = document.getElementById('nav-toggle');
        var menu = document.getElementById('nav-menu');
        if (!nav || !toggle || !menu) return;

        var links = Array.prototype.slice.call(menu.querySelectorAll('.nav-link'));

        function setMenu(open) {
            menu.classList.toggle('is-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        }

        toggle.addEventListener('click', function () { setMenu(!menu.classList.contains('is-open')); });
        links.forEach(function (a) { a.addEventListener('click', function () { setMenu(false); }); });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && menu.classList.contains('is-open')) { setMenu(false); toggle.focus(); }
        });
        document.addEventListener('click', function (e) {
            if (menu.classList.contains('is-open') && !nav.contains(e.target)) setMenu(false);
        });
        window.addEventListener('resize', function () { if (window.innerWidth > 880) setMenu(false); });

        function onScroll() { nav.classList.toggle('is-scrolled', window.scrollY > 8); }
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });

        if (!('IntersectionObserver' in window)) return;

        var map = {};
        links.forEach(function (a) { map[a.getAttribute('href').slice(1)] = a; });

        function setActive(id) {
            links.forEach(function (a) {
                if (a === map[id]) a.setAttribute('aria-current', 'true');
                else a.removeAttribute('aria-current');
            });
        }

        var spy = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) { if (e.isIntersecting) setActive(e.target.id); });
        }, { rootMargin: '-45% 0px -50% 0px' });

        Object.keys(map).forEach(function (id) {
            var el = document.getElementById(id);
            if (el) spy.observe(el);
        });

        setActive('home');
    })();
</script>

<script>
    // Hero QR: the QR breaks into pieces, then the pieces fly in and join up.
    // Plays whenever the QR scrolls into view.
    (function () {
        var qr = document.getElementById('hero-qr');
        if (!qr) return;
        var svg = qr.querySelector('svg');
        if (!svg) return;

        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduce || !('IntersectionObserver' in window) || !qr.animate) return;

        var N = 6; // 6 x 6 = 36 pieces. Use 8 for smaller pieces.
        qr.style.setProperty('--n', N);

        var markup = svg.outerHTML;
        var tiles = document.createElement('div');
        tiles.className = 'qr-tiles';
        tiles.setAttribute('aria-hidden', 'true');
        var pieces = [];

        for (var r = 0; r < N; r++) {
            for (var c = 0; c < N; c++) {
                var tile = document.createElement('div');
                tile.className = 'qr-tile';
                var inner = document.createElement('div');
                inner.className = 'qr-tile-inner';
                inner.style.left = (-c * 100) + '%';
                inner.style.top = (-r * 100) + '%';
                inner.innerHTML = markup;
                tile.appendChild(inner);
                tiles.appendChild(tile);
                pieces.push(tile);
            }
        }
        qr.appendChild(tiles);

        var running = [];

        function cancel() {
            running.forEach(function (a) { a.cancel(); });
            running = [];
            qr.classList.remove('is-assembling');
        }

        function play() {
            cancel();
            qr.classList.add('is-assembling');
            var done = 0;
            pieces.forEach(function (p) {
                var angle = Math.random() * Math.PI * 2;
                var dist = 140 + Math.random() * 180;
                var x = Math.cos(angle) * dist;
                var y = Math.sin(angle) * dist;
                var rot = (Math.random() - 0.5) * 160;
                var anim = p.animate([
                    { transform: 'translate(' + x + 'px,' + y + 'px) rotate(' + rot + 'deg) scale(.4)', opacity: 0 },
                    { transform: 'none', opacity: 1 }
                ], {
                    duration: 900 + Math.random() * 500,
                    delay: Math.random() * 350,
                    easing: 'cubic-bezier(.2,.8,.2,1)',
                    fill: 'backwards'
                });
                running.push(anim);
                anim.onfinish = function () {
                    done++;
                    // swap back to the one-piece QR so there are no seams between tiles
                    if (done === pieces.length) qr.classList.remove('is-assembling');
                };
            });
        }

        new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) play(); else cancel();
            });
        }, { threshold: 0.5 }).observe(qr);
    })();
</script>
</body>
</html>
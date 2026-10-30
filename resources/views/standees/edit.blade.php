@extends('layouts.admin')

@section('content')
    <div class="page-narrow">
        <a href="{{ route('standees.index') }}" class="back">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back To Home Page
        </a>

        {{-- Header --}}
        <div class="page-head">
            <div class="page-head-row">
                <div>
                    <h2 class="page-title">{{ $standee->name }}</h2>
                    <div class="meta">
                        <span class="code">{{ $standee->code }}</span>
                        <span class="badge {{ $standee->mode === 'multi' ? 'badge-multi' : 'badge-single' }}" style="{{ $standee->mode === 'multi' ? '' : 'color:#fff;border-color:rgba(255,255,255,.5)' }}">
                            {{ $standee->mode === 'multi' ? 'Multi page' : 'Single page' }}
                        </span>
                    </div>
                </div>
                <a href="{{ $pageUrl }}" target="_blank" class="btn btn-sun">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Open page
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-ok">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-err">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9L2.4 18a2 2 0 001.7 3h15.8a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Page settings --}}
        <form method="POST" action="{{ route('standees.updatePage', $standee) }}" class="panel stack">
            @csrf
            @method('PUT')
            <div class="panel-head">
                <span class="panel-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.3 4.3a1.7 1.7 0 013.4 0 1.7 1.7 0 002.5 1l.1-.1a1.7 1.7 0 012.4 2.4l-.1.1a1.7 1.7 0 001 2.5 1.7 1.7 0 010 3.4 1.7 1.7 0 00-1 2.5l.1.1a1.7 1.7 0 01-2.4 2.4l-.1-.1a1.7 1.7 0 00-2.5 1 1.7 1.7 0 01-3.4 0 1.7 1.7 0 00-2.5-1l-.1.1a1.7 1.7 0 01-2.4-2.4l.1-.1a1.7 1.7 0 00-1-2.5 1.7 1.7 0 010-3.4 1.7 1.7 0 001-2.5l-.1-.1a1.7 1.7 0 012.4-2.4l.1.1a1.7 1.7 0 002.5-1z"/><circle cx="12" cy="12" r="3"/></svg>
                </span>
                <div>
                    <h3 class="panel-title">Page settings</h3>
                    <p class="panel-sub">This is what visitors see after scanning the QR code.</p>
                </div>
            </div>

            <div>
                <label class="label">Mode</label>
                <select name="mode" class="input input-full">
                    <option value="single" @selected($standee->mode === 'single')>Single: For Single Page</option>
                    <option value="multi" @selected($standee->mode === 'multi')>Multi: landing page, Multiple Page Buttons</option>
                </select>
            </div>

            <div>
                <label class="label">Single link (used in Single mode)</label>
                <input name="destination_url" value="{{ $standee->destination_url }}" placeholder="https://..." class="input input-full">
                <p class="hint">Visitors are sent straight to this link when mode is Single.</p>
            </div>

            <div>
                <label class="label">Title (business Name)</label>
                <input name="page_title" value="{{ $standee->page_title }}" class="input input-full">
            </div>

            <div>
                <label class="label">Description (optional)</label>
                <input name="page_subtitle" value="{{ $standee->page_subtitle }}" class="input input-full">
            </div>

            <button class="btn btn-sun">Save settings</button>
        </form>

        {{-- Links list --}}
        <div class="panel">
            <div class="panel-head">
                <span class="panel-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.8 10.2a4 4 0 010 5.6l-3 3a4 4 0 01-5.6-5.6l1.5-1.5M10.2 13.8a4 4 0 010-5.6l3-3a4 4 0 015.6 5.6l-1.5 1.5"/></svg>
                </span>
                <div>
                    <h3 class="panel-title">Links <span class="pill">{{ $standee->links->count() }}</span></h3>
                    <p class="panel-sub">Each link here becomes a button on the page.</p>
                </div>
            </div>

            @forelse($standee->links as $link)
                <div class="link-row">
                    <span class="link-avatar">{{ strtoupper(mb_substr($link->title, 0, 1)) }}</span>
                    <div class="link-main">
                        <div class="link-title">{{ $link->title }}</div>
                        <div class="link-url">{{ $link->url }}</div>
                    </div>
                    <span class="clicks">{{ $link->clicks }} clicks</span>
                    <form method="POST" action="{{ route('standees.links.destroy', [$standee, $link]) }}"
                          onsubmit="return confirm('Are you sure you want to delete this link?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.9 12a2 2 0 01-2 1.9H7.9a2 2 0 01-2-1.9L5 7m5 4v6m4-6v6M9 7V4h6v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
            @empty
                <p class="empty-box">Link Not Created Yet.</p>
            @endforelse
        </div>

        {{-- Add link --}}
        <form method="POST" action="{{ route('standees.links.store', $standee) }}" class="panel stack">
            @csrf
            <div class="panel-head">
                <span class="panel-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                </span>
                <div>
                    <h3 class="panel-title">Add New Links</h3>
                    <p class="panel-sub">Enter a button name and its link.</p>
                </div>
            </div>

            <div class="grid2">
                <input name="title" placeholder="Button Name (i.e WhatsApp)" class="input input-full">
                <input name="url" placeholder="https://..." class="input input-full">
            </div>

            <button class="btn btn-sun">Add link</button>
        </form>

        {{-- View page --}}
        <div class="view-box">
            <strong>View Page:</strong>
            <a id="page-url" href="{{ $pageUrl }}" target="_blank">{{ $pageUrl }}</a>
            <button type="button" class="btn btn-dark btn-sm"
                    onclick="navigator.clipboard.writeText(document.getElementById('page-url').href).then(()=>{this.textContent='Copied!';setTimeout(()=>this.textContent='Copy link',1500)})">
                Copy link
            </button>
        </div>
    </div>
@endsection
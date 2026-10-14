<x-app-layout>
    <style>
        .st-page { background: linear-gradient(180deg, #eef2ff 0, #f3f4f6 220px); min-height: 100vh; }
        .st-back { display: inline-flex; align-items: center; gap: .4rem; font-size: .85rem; color: #4b5563; text-decoration: none;
                   background: #fff; border: 1px solid #e5e7eb; padding: .35rem .85rem; border-radius: 999px; transition: background .15s; }
        .st-back:hover { background: #f9fafb; color: #111827; }
        .st-ico { width: 1rem; height: 1rem; flex-shrink: 0; }

        /* header */
        .st-header { background: #fff; border: 1px solid #e5e7eb; border-radius: 1rem; padding: 1.1rem 1.25rem; margin: 1rem 0 1.25rem;
                     display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: .9rem;
                     box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .st-name { font-size: 1.35rem; font-weight: 700; color: #111827; line-height: 1.3; }
        .st-meta { display: flex; flex-wrap: wrap; align-items: center; gap: .5rem; margin-top: .35rem; }
        .st-code { background: #f3f4f6; border: 1px solid #e5e7eb; color: #374151; font-family: ui-monospace, monospace; font-size: .8rem;
                   font-weight: 600; padding: .1rem .55rem; border-radius: .4rem; }
        .st-badge { font-size: .75rem; font-weight: 600; padding: .15rem .65rem; border-radius: 999px; }
        .st-badge-single { background: #e0f2fe; color: #0369a1; }
        .st-badge-multi  { background: #ede9fe; color: #6d28d9; }

        /* alerts */
        .st-alert { display: flex; align-items: center; gap: .5rem; padding: .7rem .95rem; margin-bottom: 1rem; border-radius: .7rem; font-size: .875rem; border: 1px solid; }
        .st-alert-ok  { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
        .st-alert-err { background: #fef2f2; color: #991b1b; border-color: #fecaca; }

        /* cards */
        .st-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 1rem; padding: 1.35rem; margin-bottom: 1.25rem;
                   box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .st-card-head { display: flex; align-items: center; gap: .7rem; padding-bottom: .9rem; margin-bottom: 1.1rem; border-bottom: 1px solid #f1f5f9; }
        .st-card-icon { width: 2.1rem; height: 2.1rem; border-radius: .6rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .st-card-icon svg { width: 1.1rem; height: 1.1rem; }
        .ic-blue  { background: #dbeafe; color: #1d4ed8; }
        .ic-purple{ background: #ede9fe; color: #6d28d9; }
        .ic-green { background: #dcfce7; color: #15803d; }
        .st-card-title { font-size: 1.05rem; font-weight: 700; color: #111827; }
        .st-card-sub { font-size: .8rem; color: #6b7280; margin-top: .1rem; }
        .st-pill { background: #dbeafe; color: #1d4ed8; font-size: .75rem; font-weight: 600; padding: .1rem .6rem; border-radius: 999px; margin-left: .4rem; }

        /* form controls */
        .st-label { display: block; font-size: .85rem; font-weight: 600; color: #374151; margin-bottom: .3rem; }
        .st-hint { font-size: .75rem; color: #6b7280; margin-top: .25rem; }
        .st-input { width: 100%; border: 1px solid #d1d5db; border-radius: .6rem; padding: .55rem .8rem; font-size: .875rem; background: #fff; transition: border .15s, box-shadow .15s; }
        .st-input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.2); }
        .st-grid2 { display: grid; grid-template-columns: 1fr; gap: .75rem; }
        @media (min-width: 640px) { .st-grid2 { grid-template-columns: 1fr 1.6fr; } }

        .st-btn { display: inline-flex; align-items: center; gap: .4rem; color: #fff; font-size: .85rem; font-weight: 500; padding: .55rem 1.15rem; border-radius: .6rem;
                  border: 0; cursor: pointer; text-decoration: none; transition: background .15s, transform .05s; }
        .st-btn:active { transform: scale(.97); }
        .st-blue  { background: #2563eb; } .st-blue:hover  { background: #1d4ed8; }
        .st-green { background: #16a34a; } .st-green:hover { background: #15803d; }
        .st-dark  { background: #1f2937; } .st-dark:hover  { background: #111827; }
        .st-del { display: inline-flex; align-items: center; gap: .3rem; background: #fff; color: #dc2626; border: 1px solid #fecaca; font-size: .8rem; font-weight: 500;
                  padding: .35rem .75rem; border-radius: .55rem; cursor: pointer; transition: background .15s, color .15s; }
        .st-del:hover { background: #dc2626; color: #fff; border-color: #dc2626; }

        /* link rows */
        .st-link-row { display: flex; align-items: center; gap: .8rem; padding: .8rem .6rem; border-bottom: 1px solid #f1f5f9; border-radius: .6rem; transition: background .15s; }
        .st-link-row:last-child { border-bottom: 0; }
        .st-link-row:hover { background: #f8fafc; }
        .st-avatar { width: 2.4rem; height: 2.4rem; border-radius: 999px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: #fff;
                     font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .st-link-title { font-weight: 600; color: #111827; }
        .st-link-url { font-size: .75rem; color: #6b7280; }
        .st-clicks { background: #eff6ff; color: #1d4ed8; font-size: .8rem; font-weight: 600; padding: .2rem .7rem; border-radius: 999px; white-space: nowrap; }
        .st-empty { text-align: center; color: #6b7280; font-size: .875rem; padding: 1.6rem 0; background: #f9fafb; border: 1px dashed #d1d5db; border-radius: .8rem; }

        /* view page box */
        .st-view { background: #fff; border: 1px solid #e5e7eb; border-radius: 1rem; padding: .95rem 1.2rem; font-size: .875rem; color: #374151;
                   box-shadow: 0 1px 2px rgba(0,0,0,.05); display: flex; flex-wrap: wrap; align-items: center; gap: .6rem; }
        .st-view a { color: #2563eb; text-decoration: none; font-weight: 500; word-break: break-all; }
        .st-view a:hover { text-decoration: underline; }
        .st-copy { margin-left: auto; background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; font-size: .78rem; font-weight: 500;
                   padding: .3rem .75rem; border-radius: .5rem; cursor: pointer; }
        .st-copy:hover { background: #e5e7eb; }
    </style>

    <div class="st-page">
    <div class="max-w-3xl mx-auto p-4">
        <a href="{{ route('standees.index') }}" class="st-back">
            <svg class="st-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Back To Home Page
        </a>

        {{-- Header --}}
        <div class="st-header">
            <div>
                <h2 class="st-name">{{ $standee->name }}</h2>
                <div class="st-meta">
                    <span class="st-code">{{ $standee->code }}</span>
                    <span class="st-badge {{ $standee->mode === 'multi' ? 'st-badge-multi' : 'st-badge-single' }}">
                        {{ $standee->mode === 'multi' ? 'Multi page' : 'Single page' }}
                    </span>
                </div>
            </div>
            <a href="{{ route('qr.redirect', $standee->code) }}" target="_blank" class="st-btn st-dark">
                <svg class="st-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Open page
            </a>
        </div>

        @if(session('success'))
            <div class="st-alert st-alert-ok">
                <svg class="st-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="st-alert st-alert-err">
                <svg class="st-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.3 3.9L2.4 18a2 2 0 001.7 3h15.8a2 2 0 001.7-3L13.7 3.9a2 2 0 00-3.4 0z"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Page settings --}}
        <form method="POST" action="{{ route('standees.updatePage', $standee) }}" class="st-card space-y-3">
            @csrf
            @method('PUT')
            <div class="st-card-head">
                <span class="st-card-icon ic-blue">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.3 4.3a1.7 1.7 0 013.4 0 1.7 1.7 0 002.5 1l.1-.1a1.7 1.7 0 012.4 2.4l-.1.1a1.7 1.7 0 001 2.5 1.7 1.7 0 010 3.4 1.7 1.7 0 00-1 2.5l.1.1a1.7 1.7 0 01-2.4 2.4l-.1-.1a1.7 1.7 0 00-2.5 1 1.7 1.7 0 01-3.4 0 1.7 1.7 0 00-2.5-1l-.1.1a1.7 1.7 0 01-2.4-2.4l.1-.1a1.7 1.7 0 00-1-2.5 1.7 1.7 0 010-3.4 1.7 1.7 0 001-2.5l-.1-.1a1.7 1.7 0 012.4-2.4l.1.1a1.7 1.7 0 002.5-1z"/><circle cx="12" cy="12" r="3"/></svg>
                </span>
                <div>
                    <h3 class="st-card-title">Page settings</h3>
                    <p class="st-card-sub">This is what visitors see after scanning the QR code.</p>
                </div>
            </div>

            <div>
                <label class="st-label">Mode</label>
                <select name="mode" class="st-input">
                    <option value="single" @selected($standee->mode === 'single')>Single: For Single Page</option>
                    <option value="multi" @selected($standee->mode === 'multi')>Multi: landing page, Multiple Page Buttons</option>
                </select>
            </div>

            <div>
                <label class="st-label">Title (business Name)</label>
                <input name="page_title" value="{{ $standee->page_title }}" class="st-input">
            </div>

            <div>
                <label class="st-label">Description (optional)</label>
                <input name="page_subtitle" value="{{ $standee->page_subtitle }}" class="st-input">
            </div>

            <button class="st-btn st-blue">Save settings</button>
        </form>

        {{-- Links list --}}
        <div class="st-card">
            <div class="st-card-head">
                <span class="st-card-icon ic-purple">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.8 10.2a4 4 0 010 5.6l-3 3a4 4 0 01-5.6-5.6l1.5-1.5M10.2 13.8a4 4 0 010-5.6l3-3a4 4 0 015.6 5.6l-1.5 1.5"/></svg>
                </span>
                <div>
                    <h3 class="st-card-title">Links <span class="st-pill">{{ $standee->links->count() }}</span></h3>
                    <p class="st-card-sub">Each link here becomes a button on the page.</p>
                </div>
            </div>

            @forelse($standee->links as $link)
                <div class="st-link-row">
                    <span class="st-avatar">{{ strtoupper(mb_substr($link->title, 0, 1)) }}</span>
                    <div class="flex-1 min-w-0">
                        <div class="st-link-title">{{ $link->title }}</div>
                        <div class="st-link-url truncate">{{ $link->url }}</div>
                    </div>
                    <span class="st-clicks">{{ $link->clicks }} clicks</span>
                    <form method="POST" action="{{ route('standees.links.destroy', [$standee, $link]) }}"
                          onsubmit="return confirm('Are you sure you want to delete this link?')">
                        @csrf
                        @method('DELETE')
                        <button class="st-del">
                            <svg class="st-ico" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.9 12a2 2 0 01-2 1.9H7.9a2 2 0 01-2-1.9L5 7m5 4v6m4-6v6M9 7V4h6v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
            @empty
                <p class="st-empty">Link Not Created Yet.</p>
            @endforelse
        </div>

        {{-- Add link --}}
        <form method="POST" action="{{ route('standees.links.store', $standee) }}" class="st-card space-y-3">
            @csrf
            <div class="st-card-head">
                <span class="st-card-icon ic-green">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                </span>
                <div>
                    <h3 class="st-card-title">Add New Links</h3>
                    <p class="st-card-sub">Enter a button name and its link.</p>
                </div>
            </div>

            <div class="st-grid2">
                <input name="title" placeholder="Button Name (i.e WhatsApp)" class="st-input">
                <input name="url" placeholder="https://..." class="st-input">
            </div>

            <button class="st-btn st-green">Add link</button>
        </form>

        {{-- View page --}}
        <div class="st-view">
            <span>View Page:</span>
            <a id="page-url" href="{{ route('qr.redirect', $standee->code) }}" target="_blank">{{ route('qr.redirect', $standee->code) }}</a>
            <button type="button" class="st-copy"
                    onclick="navigator.clipboard.writeText(document.getElementById('page-url').href).then(()=>{this.textContent='Copied!';setTimeout(()=>this.textContent='Copy link',1500)})">
                Copy link
            </button>
        </div>
    </div>
    </div>
</x-app-layout>
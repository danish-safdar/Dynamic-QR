@extends('layouts.admin')

@section('content')
    <div class="wrap page">
        <div class="page-head">
            <div class="page-head-row">
                <div>
                    <h2 class="page-title">My Standees</h2>
                    <p class="page-sub">Manage your QR standees, destination links and scans.</p>
                </div>
                <span class="count-pill">{{ $standees->count() }} total</span>
            </div>
        </div>

        @if($standees->isEmpty())
            <div class="empty-box">No standees are assigned to your account yet. Please contact the admin.</div>
        @else
            <div class="cards">
                @foreach($standees as $s)
                    <div class="card-item">
                        <div class="card-name">
                            {{ $s->page_title ?: $s->name }}
                            <span class="badge {{ $s->mode === 'multi' ? 'badge-multi' : 'badge-single' }}">{{ $s->mode === 'multi' ? 'Multi page' : 'Single page' }}</span>
                            @unless($s->is_active)<span class="badge badge-off">Inactive</span>@endunless
                        </div>
                        <div class="meta"><span class="code">{{ $s->code }}</span></div>

                        <div class="stats">
                            <div class="stat"><b>{{ $s->scans }}</b><span>Scans</span></div>
                            <div class="stat"><b>{{ $s->links_count }}</b><span>Links</span></div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('standees.edit', $s) }}" class="btn btn-sun btn-sm">Edit page &amp; links</a>
                            <a href="{{ route('standees.qr', $s) }}" class="btn btn-dark btn-sm">Download QR</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
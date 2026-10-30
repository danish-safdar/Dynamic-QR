@extends('layouts.admin')

@section('content')
    <div class="wrap page">

        <div class="page-head">
            <div class="page-head-row">
                <div>
                    <h2 class="page-title">{{ auth()->user()->is_admin ? 'All Standees' : 'My Standees' }}</h2>
                    <p class="page-sub">Manage your QR standees, destination links and scans.</p>
                </div>
                <span class="count-pill">{{ $standees->total() }} total</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-ok">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-err">{{ $errors->first() }}</div>
        @endif

        <div class="toolbar">
            <a href="{{ route('standees.downloadAll', request()->only('q', 'owner')) }}" class="btn btn-sun">
                Download {{ $standees->total() }} QR ZIP
            </a>

            <form method="POST" action="{{ route('standees.store') }}" class="inline-form">
                @csrf
                <input type="number" name="count" value="1" min="1" max="100" class="input" style="width:5.5rem">
                <button class="btn btn-dark">Add Standees</button>
            </form>
        </div>

        <form method="GET" action="{{ route('standees.index') }}" class="toolbar toolbar-start">
            <input name="q" value="{{ request('q') }}" placeholder="Search code or name" class="input" style="width:14rem">
            @if(auth()->user()->is_admin)
                <select name="owner" class="input">
                    <option value="">All owners</option>
                    <option value="none" @selected(request('owner') === 'none')>Unassigned</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @selected((string) request('owner') === (string) $u->id)>{{ $u->name }}</option>
                    @endforeach
                </select>
            @endif
            <button class="btn btn-dark">Filter</button>
            @if(request()->filled('q') || request()->filled('owner'))
                <a href="{{ route('standees.index') }}" class="btn btn-line">Clear</a>
            @endif
        </form>

        @if(auth()->user()->is_admin)
        <form method="POST" action="{{ route('standees.assign') }}" class="toolbar toolbar-start">
            @csrf
            <span class="label" style="margin:0">Assign range</span>
            <span class="inline-form">
                s <input type="number" name="from" min="1" placeholder="from" class="input" style="width:5.5rem" required>
                to s <input type="number" name="to" min="1" placeholder="to" class="input" style="width:5.5rem" required>
                <select name="user_id" class="input">
                    <option value="">Unassigned</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-dark">Assign</button>
            </span>
        </form>
        @endif

        <div class="table-card">
            <div class="table-scroll">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Destination link</th>
                            <th>Active</th>
                            <th>Scans</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($standees as $s)
                        <tr class="{{ $s->is_active ? 'row-on' : 'row-off' }}">
                            <td><span class="code">{{ $s->code }}</span></td>
                            <td colspan="4">
                                <form id="f-{{ $s->id }}" method="POST" action="{{ route('standees.update', $s) }}" class="row-form">
                                    @csrf
                                    @method('PUT')
                                    <input name="name" value="{{ $s->name }}" class="input f-name">
                                    <input name="destination_url" value="{{ $s->destination_url }}" class="input f-url">
                                    @if(auth()->user()->is_admin)
                                    <select name="user_id" class="input f-owner">
                                        <option value="">Unassigned</option>
                                        @foreach($users as $u)
                                            <option value="{{ $u->id }}" @selected($s->user_id === $u->id)>{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    <label class="check-label">
                                        <input type="checkbox" name="is_active" value="1" @checked($s->is_active)> Active
                                    </label>
                                    <span class="scans">{{ $s->scans }}</span>
                                    <button class="btn btn-sun btn-sm">Save</button>
                                </form>
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('standees.qr', $s) }}" class="btn btn-dark btn-sm">QR</a>
                                    <a href="{{ route('standees.edit', $s) }}" class="btn btn-line btn-sm">Links{{ $s->mode === 'multi' ? ' (multi)' : '' }}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">No standees found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($standees->hasPages())
            <div class="pager">
                @if($standees->onFirstPage())
                    <span class="btn btn-sm btn-disabled">Previous</span>
                @else
                    <a href="{{ $standees->previousPageUrl() }}" class="btn btn-sm btn-line">Previous</a>
                @endif

                <span class="pager-info">Page {{ $standees->currentPage() }} of {{ $standees->lastPage() }}</span>

                @if($standees->hasMorePages())
                    <a href="{{ $standees->nextPageUrl() }}" class="btn btn-sm btn-line">Next</a>
                @else
                    <span class="btn btn-sm btn-disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
@endsection
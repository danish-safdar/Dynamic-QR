@extends('layouts.admin')

@section('content')
    <style>
        .u-wrap { max-width: 64rem; margin: 0 auto; padding: 1rem; }
        .u-title { font-size: 1.5rem; font-weight: 700; margin: .5rem 0 1rem; }
        .u-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 1rem; padding: 1.1rem; margin-bottom: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .u-input { border: 1px solid #d1d5db; border-radius: .5rem; padding: .45rem .7rem; font-size: .875rem; background: #fff; }
        .u-btn { color: #fff; border: 0; border-radius: .5rem; padding: .45rem .9rem; font-size: .85rem; cursor: pointer; }
        .u-green { background: #16a34a; } .u-blue { background: #2563eb; } .u-red { background: #dc2626; }
        .u-alert-ok { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; padding: .6rem .9rem; border-radius: .6rem; margin-bottom: 1rem; font-size: .875rem; }
        .u-alert-err { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: .6rem .9rem; border-radius: .6rem; margin-bottom: 1rem; font-size: .875rem; }
        .u-table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        .u-table th { text-align: left; padding: .6rem; color: #4b5563; border-bottom: 1px solid #e5e7eb; }
        .u-table td { padding: .6rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .u-role { font-size: .75rem; font-weight: 600; padding: .1rem .6rem; border-radius: 999px; }
        .r-admin { background: #fef3c7; color: #92400e; } .r-user { background: #e0f2fe; color: #0369a1; }
        .u-row { display: flex; flex-wrap: wrap; gap: .5rem; }
    </style>

    <div class="u-wrap">
        <h2 class="u-title">Users ({{ $users->count() }})</h2>

        @if(session('success'))<div class="u-alert-ok">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="u-alert-err">{{ $errors->first() }}</div>@endif

        <form method="POST" action="{{ route('users.store') }}" class="u-card">
            @csrf
            <strong>Add new user</strong>
            <div class="u-row" style="margin-top:.7rem">
                <input class="u-input" name="name" placeholder="Name" value="{{ old('name') }}" required>
                <input class="u-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input class="u-input" type="text" name="password" placeholder="Password (min 8)" required>
                <button class="u-btn u-green">Create user</button>
            </div>
            <p style="font-size:.78rem;color:#6b7280;margin-top:.5rem">After creating, give them their standees from the Standees page (Owner column or the range form).</p>
        </form>

        <div class="u-card" style="overflow-x:auto">
            <table class="u-table">
                <thead>
                    <tr><th>Name</th><th>Email</th><th>Role</th><th>Standees</th><th>New password</th><th></th></tr>
                </thead>
                <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td><span class="u-role {{ $u->is_admin ? 'r-admin' : 'r-user' }}">{{ $u->is_admin ? 'Admin' : 'User' }}</span></td>
                        <td>{{ $u->standees_count }}</td>
                        <td>
                            <form method="POST" action="{{ route('users.update', $u) }}" class="u-row">
                                @csrf
                                @method('PUT')
                                <input class="u-input" type="text" name="password" placeholder="New password" style="width:9rem" required>
                                <button class="u-btn u-blue">Set</button>
                            </form>
                        </td>
                        <td>
                            @if($u->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $u) }}" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="u-btn u-red">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

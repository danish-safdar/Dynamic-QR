<x-app-layout>
    <style>
        .st-page { background: #f3f4f6; min-height: 100vh; }
        .st-title { font-size: 1.5rem; font-weight: 700; color: #111827; display: flex; align-items: center; gap: .6rem; }
        .st-count { background: #dbeafe; color: #1d4ed8; font-size: .8rem; font-weight: 600; padding: .15rem .65rem; border-radius: 999px; }

        .st-alert { padding: .65rem .9rem; margin-bottom: .9rem; border-radius: .6rem; font-size: .875rem; border: 1px solid; }
        .st-alert-ok  { background: #f0fdf4; color: #166534; border-color: #bbf7d0; }
        .st-alert-err { background: #fef2f2; color: #991b1b; border-color: #fecaca; }

        .st-toolbar { background: #fff; border: 1px solid #e5e7eb; border-radius: .9rem; padding: .9rem 1rem; margin-bottom: 1.1rem;
                      display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: .75rem;
                      box-shadow: 0 1px 2px rgba(0,0,0,.05); }

        .st-btn { display: inline-block; color: #fff; font-size: .85rem; font-weight: 500; padding: .45rem .95rem; border-radius: .5rem;
                  border: 0; cursor: pointer; text-decoration: none; transition: background .15s, transform .05s; }
        .st-btn:active { transform: scale(.97); }
        .st-green  { background: #16a34a; } .st-green:hover  { background: #15803d; }
        .st-blue   { background: #2563eb; } .st-blue:hover   { background: #1d4ed8; }
        .st-dark   { background: #1f2937; } .st-dark:hover   { background: #111827; }
        .st-purple { background: #7c3aed; } .st-purple:hover { background: #6d28d9; }

        .st-input { border: 1px solid #d1d5db; border-radius: .5rem; padding: .4rem .65rem; font-size: .875rem; background: #fff; }
        .st-input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,.2); }

        .st-card { background: #fff; border: 1px solid #e5e7eb; border-radius: .9rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
        .st-table { width: 100%; border-collapse: collapse; }
        .st-table thead tr { background: #f9fafb; border-bottom: 1px solid #e5e7eb; }
        .st-table th { padding: .8rem .75rem; font-size: .8rem; font-weight: 600; color: #4b5563; text-align: left; }
        .st-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background .15s; }
        .st-table tbody tr:last-child { border-bottom: 0; }
        .st-table tbody tr:hover { background: #f8fafc; }
        .st-table td { padding: .7rem .75rem; vertical-align: middle; }

        .st-code { display: inline-block; background: #f3f4f6; color: #374151; font-weight: 600; padding: .2rem .55rem; border-radius: .4rem; }
        .st-scans { display: inline-block; min-width: 2.5rem; text-align: center; background: #eff6ff; color: #1d4ed8; font-weight: 600; padding: .15rem .5rem; border-radius: 999px; }
        .st-check { accent-color: #16a34a; width: 1rem; height: 1rem; cursor: pointer; }
        .st-active { cursor: pointer; font-size: .85rem; color: #374151; }
    </style>

    <div class="st-page">
    <div class="max-w-6xl mx-auto p-4">
        <h2 class="st-title mb-4">
            Standees
            <span class="st-count">{{ $standees->count() }}</span>
        </h2>

        @if(session('success'))
            <div class="st-alert st-alert-ok">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="st-alert st-alert-err">{{ $errors->first() }}</div>
        @endif

        <div class="st-toolbar">
            <a href="{{ route('standees.downloadAll') }}" class="st-btn st-green">
                Download {{ $standees->count() }} QR ZIP
            </a>

            <form method="POST" action="{{ route('standees.store') }}" class="inline-flex gap-2 items-center">
                @csrf
                <input type="number" name="count" value="50" min="1" max="100" class="st-input w-20">
                <button class="st-btn st-blue">Add 50 New Standees</button>
            </form>
        </div>

        <div class="st-card">
        <div class="overflow-x-auto">
            <table class="st-table text-sm">
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
                @foreach($standees as $s)
                    <tr>
                        <td class="font-mono"><span class="st-code">{{ $s->code }}</span></td>
                        <td colspan="4">
                            <form id="f-{{ $s->id }}" method="POST" action="{{ route('standees.update', $s) }}" class="flex gap-2 items-center">
                                @csrf
                                @method('PUT')
                                <input name="name" value="{{ $s->name }}" class="st-input w-40">
                                <input name="destination_url" value="{{ $s->destination_url }}" class="st-input flex-1">
                                <label class="st-active flex items-center gap-1">
                                    <input type="checkbox" name="is_active" value="1" class="st-check" @checked($s->is_active)> Active
                                </label>
                                <span class="w-16 text-center"><span class="st-scans">{{ $s->scans }}</span></span>
                                <button class="st-btn st-blue">Save</button>
                            </form>
                        </td>
                        <td class="whitespace-nowrap">
                            <a href="{{ route('standees.qr', $s) }}" class="st-btn st-dark">QR</a>
                            <a href="{{ route('standees.edit', $s) }}" class="st-btn st-purple ml-2">Links{{ $s->mode === 'multi' ? ' (multi)' : '' }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</x-app-layout>
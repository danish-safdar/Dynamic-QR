<?php

namespace App\Http\Controllers;

use App\Models\Standee;
use App\Models\StandeeLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StandeeController extends Controller
{
    // Admin can touch everything, a normal user only their own standees
    private function authorizeStandee(Standee $standee): void
    {
        $user = auth()->user();
        abort_unless($user->is_admin || $standee->user_id === $user->id, 403);
    }

    // QR and page links always use APP_URL (the final domain)
    private function qrUrl(string $code): string
    {
        return rtrim(config('app.url'), '/') . '/' . $code;
    }

    // Admin sees everything, a normal user only their own standees
    private function visibleStandees()
    {
        $q = Standee::query();
        if (! auth()->user()->is_admin) {
            $q->where('user_id', auth()->id());
        }

        return $q;
    }

    // Visible standees + optional search (?q=) and owner filter (?owner=, admin only)
    private function filteredStandees(Request $request)
    {
        $q = $this->visibleStandees();

        if (auth()->user()->is_admin && $request->filled('owner')) {
            $request->input('owner') === 'none'
                ? $q->whereNull('user_id')
                : $q->where('user_id', (int) $request->input('owner'));
        }

        if ($request->filled('q')) {
            $term = '%' . $request->input('q') . '%';
            $q->where(fn ($w) => $w->where('code', 'like', $term)->orWhere('name', 'like', $term));
        }

        return $q;
    }

    public function index(Request $request)
    {
        $users = auth()->user()->is_admin ? \App\Models\User::orderBy('name')->get() : collect();

        $standees = $this->filteredStandees($request)
            ->orderBy('number')
            ->paginate(50)
            ->withQueryString();

        return view('standees.index', compact('standees', 'users'));
    }

    public function update(Request $request, Standee $standee)
    {
        $this->authorizeStandee($standee);

        $rules = [
            'name' => 'required|string|max:255',
            'destination_url' => ['nullable', 'url', 'regex:/^https?:\/\//i'],
        ];
        if (auth()->user()->is_admin) {
            $rules['user_id'] = 'nullable|exists:users,id';
        }

        $data = $request->validate($rules);

        if (auth()->user()->is_admin) {
            $data['user_id'] = $request->input('user_id') ?: null;
        }
        $data['is_active'] = $request->boolean('is_active');
        $standee->update($data);

        return back()->with('success', "{$standee->code}  link updated.");
    }

    public function qr(Standee $standee)
    {
        $this->authorizeStandee($standee);
        $svg = QrCode::format('svg')
            ->size(600)
            ->margin(2)
            ->errorCorrection('M')
            ->generate($this->qrUrl($standee->code));

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="' . $standee->code . '.svg"',
        ]);
    }

    public function downloadAll(Request $request)
    {
        $query = $this->filteredStandees($request)->orderBy('number');

        abort_if($query->count() > 1000, 422, 'Too many standees for one ZIP. Filter by owner or search first.');

        $zipPath = storage_path('app/standee-qrs-' . auth()->id() . '.zip');
        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Could not create ZIP.');
        }

        foreach ($query->get(['id', 'code']) as $s) {
            $svg = QrCode::format('svg')
                ->size(600)
                ->margin(2)
                ->errorCorrection('M')
                ->generate($this->qrUrl($s->code));
            $zip->addFromString($s->code . '.svg', $svg);
        }

        $zip->close();

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'count' => 'required|integer|min:1|max:100',
        ]);

        DB::transaction(function () use ($data) {
            $last = (int) Standee::lockForUpdate()->max('number');
            $now = now();
            $rows = [];

            for ($i = 1; $i <= $data['count']; $i++) {
                $n = $last + $i;
                $rows[] = [
                    'name' => "Standee {$n}",
                    'code' => "s{$n}",
                    'number' => $n,
                    'user_id' => auth()->id(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            Standee::insert($rows);
        }, 3);

        return back()->with('success', "{$data['count']} New Standees Created.");
    }

    public function edit(Standee $standee)
    {
        $this->authorizeStandee($standee);
        $standee->load('links');
        $pageUrl = $this->qrUrl($standee->code);
        return view('standees.edit', compact('standee', 'pageUrl'));
    }

    public function updatePage(Request $request, Standee $standee)
    {
        $this->authorizeStandee($standee);
        $data = $request->validate([
            'mode' => 'required|in:single,multi',
            'page_title' => 'nullable|string|max:255',
            'page_subtitle' => 'nullable|string|max:255',
            'destination_url' => ['nullable', 'required_if:mode,single', 'url', 'regex:/^https?:\/\//i'],
        ]);

        if (empty($data['destination_url'])) {
            unset($data['destination_url']);
        }

        $standee->update($data);

        return back()->with('success', ' settings saved.');
    }

    public function storeLink(Request $request, Standee $standee)
    {
        $this->authorizeStandee($standee);
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'url' => ['required', 'url', 'regex:/^https?:\/\//i'],
        ]);

        $data['sort_order'] = ((int) $standee->links()->max('sort_order')) + 1;
        $standee->links()->create($data);

        return back()->with('success', 'Link added.');
    }

    public function destroyLink(Standee $standee, StandeeLink $link)
    {
        $this->authorizeStandee($standee);
        abort_unless($link->standee_id === $standee->id, 404);
        $link->delete();

        return back()->with('success', 'Link deleted.');
    }

    // Admin: give a range of standees (e.g. 51 to 60) to one user
    public function assign(Request $request)
    {
        $data = $request->validate([
            'from' => 'required|integer|min:1',
            'to' => 'required|integer|gte:from',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $count = Standee::whereBetween('number', [$data['from'], $data['to']])
            ->update(['user_id' => $request->input('user_id') ?: null]);

        return back()->with('success', "{$count} standees assigned.");
    }
}
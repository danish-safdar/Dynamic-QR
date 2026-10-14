<?php

namespace App\Http\Controllers;

use App\Models\Standee;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\StandeeLink;

class StandeeController extends Controller
{
    public function index()
    {
        $standees = Standee::all()
            ->sortBy(fn ($s) => (int) substr($s->code, 1))
            ->values();

        return view('standees.index', compact('standees'));
    }

    public function update(Request $request, Standee $standee)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'destination_url' => ['required', 'url', 'regex:/^https?:\/\//i'],
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $standee->update($data);

        return back()->with('success', "{$standee->code}  link updated.");
    }

    public function qr(Standee $standee)
    {
        $svg = QrCode::format('svg')
            ->size(600)
            ->margin(2)
            ->errorCorrection('M')
            ->generate(route('qr.redirect', $standee->code));

        return response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="' . $standee->code . '.svg"',
        ]);
    }

    public function downloadAll()
    {
        $zipPath = storage_path('app/standee-qrs.zip');
        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            abort(500, 'ZIP Created');
        }

        foreach (Standee::all() as $s) {
            $svg = QrCode::format('svg')
                ->size(600)
                ->margin(2)
                ->errorCorrection('M')
                ->generate(route('qr.redirect', $s->code));
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

    $last = Standee::all()->map(fn ($s) => (int) substr($s->code, 1))->max() ?? 0;

    for ($i = 1; $i <= $data['count']; $i++) {
        $n = $last + $i;
        Standee::create([
            'name' => "Standee {$n}",
            'code' => "s{$n}",
            'destination_url' => 'https://junooo.shop',
        ]);
    }

    return back()->with('success', "{$data['count']} New Standees Created.");
}
    public function edit(Standee $standee)
    {
        $standee->load('links');
        return view('standees.edit', compact('standee'));
    }

    public function updatePage(Request $request, Standee $standee)
    {
        $data = $request->validate([
            'mode' => 'required|in:single,multi',
            'page_title' => 'nullable|string|max:255',
            'page_subtitle' => 'nullable|string|max:255',
        ]);

        $standee->update($data);

        return back()->with('success', ' settings saved.');
    }

    public function storeLink(Request $request, Standee $standee)
    {
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
        abort_unless($link->standee_id === $standee->id, 404);
        $link->delete();

        return back()->with('success', 'Link deleted.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Standee;
use App\Models\StandeeLink;

class RedirectController extends Controller
{
    // QR scan par ye chalta hai
    public function __invoke(string $code)
    {
        $standee = Standee::where('code', $code)->firstOrFail();

        if (! $standee->is_active) {
            return response()->view('inactive', [], 404);
        }

        // Multi mode: landing page
        if ($standee->mode === 'multi') {
            $links = $standee->links;

            if ($links->count() > 0) {
                $this->recordScan($standee);

                return view('landing', compact('standee', 'links'));
            }
        }

        // Single mode: seedha redirect
        if (! $standee->destination_url) {
            return response()->view('inactive', [], 404);
        }

        $this->recordScan($standee);

        return redirect()->away($standee->destination_url, 302);
    }

    // Landing page ke button par click
    public function click(StandeeLink $link)
    {
        if (! $link->standee->is_active) {
            return response()->view('inactive', [], 404);
        }

        $link->increment('clicks');

        return redirect()->away($link->url, 302);
    }

    // Scan count aur last scan time ek hi query mein
    private function recordScan(Standee $standee): void
    {
        $standee->increment('scans', 1, ['last_scanned_at' => now()]);
    }
}
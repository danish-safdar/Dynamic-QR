<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StandeeLink extends Model
{
    protected $fillable = ['standee_id', 'title', 'url', 'sort_order', 'clicks'];

    public function standee(): BelongsTo
    {
        return $this->belongsTo(Standee::class);
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

        return back()->with('success', 'Page settings save ho gayin.');
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
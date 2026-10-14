<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Standee extends Model
{
    protected $fillable = [
        'name', 'code', 'destination_url', 'scans', 'is_active', 'last_scanned_at',
        'mode', 'page_title', 'page_subtitle',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_scanned_at' => 'datetime',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(StandeeLink::class)->orderBy('sort_order')->orderBy('id');
    }
}
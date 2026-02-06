<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntryImage extends Model
{
    protected $fillable = ['entry_id', 'field', 'path', 'position'];

    public function entry(): BelongsTo
    {
        return $this->belongsTo(Entry::class);
    }
}

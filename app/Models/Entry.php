<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Entry extends Resource
{
    protected $fillable = ['number', 'unit', 'subject_id'];

    public function translations(): HasMany
    {
        return $this->hasMany(EntryTranslation::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(EntryImage::class);
    }

    public function imagesByField(string $field): HasMany
    {
        return $this->hasMany(EntryImage::class)->where('field', $field);
    }
}

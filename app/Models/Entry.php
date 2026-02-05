<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entry extends Model
{
    protected $fillable = ['number', 'unit', 'subject_id'];

    public function translations(): HasMany
    {
        return $this->hasMany(EntryTranslation::class);
    }

    public function translation($localeId = null): null
    {
        $localeId = $localeId ?? app()->getLocale();

        return $this->translations()->where('locale_id', $localeId)->first();
    }
}

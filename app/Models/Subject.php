<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

class Subject extends Model
{
    protected $fillable = ['units'];

    public function translations(): HasMany
    {
        return $this->hasMany(SubjectTranslation::class);
    }

    public function translation($localeId = null)
    {
        $localeId = $localeId ?? $this->getCurrentLocaleId();
        $defaultLocaleId = config('app.default_locale_id', 1);

        return $this->translations
            ->where('locale_id', $localeId)
            ->first()
            ?? $this->translations
                ->where('locale_id', $defaultLocaleId)
                ->first();
    }

    public function __get($key)
    {
        if (in_array($key, ['id', 'units', 'created_at', 'updated_at', 'translations'])) {
            return parent::__get($key);
        }

        $translation = $this->translation();

        if ($translation && isset($translation->$key)) {
            return $translation->$key;
        }

        return parent::__get($key);
    }

    protected function getCurrentLocaleId()
    {
        $currentLocaleCode = App::getLocale();

        return cache()->remember(
            "locale_id_{$currentLocaleCode}",
            3600,
            fn () => Locale::where('code', $currentLocaleCode)->value('id') ?? config('app.default_locale_id', 1)
        );
    }
}

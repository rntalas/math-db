<?php

namespace App\Providers;

use App\Models\Locale;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', static function ($view) {
            $currentLocaleCode = App::getLocale();
            $currentLocaleId = cache()->remember(
                "locale_id_{$currentLocaleCode}",
                3600,
                fn () => Locale::query()->where('code', $currentLocaleCode)->value('id') ?? config('app.default_locale_id', 1)
            );

            $view->with('currentLocaleId', $currentLocaleId);
        });

        View::composer('partials.header', static function ($view) {
            $view->with(
                'locales',
                Locale::query()->select('id', 'code', 'name', 'image')->get(),
            );
        });
    }
}

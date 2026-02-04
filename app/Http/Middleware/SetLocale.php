<?php

namespace App\Http\Middleware;

use App\Models\Locale;
use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $available = Locale::query()->pluck('code')->toArray();

        $locale = $request->query('lang', session('locale', config('app.locale')));

        if (! in_array($locale, $available, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}

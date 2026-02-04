<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use App\Models\Locale;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $available = Locale::pluck('code')->toArray();

        $locale = $request->query('lang', session('locale', config('app.locale')));

        if (!in_array($locale, $available, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);
        session(['locale' => $locale]);

        return $next($request);
    }
}

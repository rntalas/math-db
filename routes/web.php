<?php

use Illuminate\Support\Facades\Route;

Route::get('/{slug?}', static function ($slug = 'home') {
    $view = 'pages.'.($slug ?? 'home');

    if (! view()->exists($view)) {
        abort(404);
    }

    $title = ucfirst(str_replace('-', ' ', $slug ?: 'home'));

    return view($view, ['title' => $title]);
})->where('slug', '.*')->name('page.show');

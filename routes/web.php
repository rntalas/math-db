<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SubjectController;

Route::resource('subjects', SubjectController::class);

Route::get('/{slug?}', [PageController::class, 'index'])
    ->where('slug', '.*')
    ->name('page.show');

<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SubjectController;

Route::prefix('subject')->group(function () {
    Route::get('add', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('add', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('{id}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('edit/{id}', [SubjectController::class, 'edit'])->name('subjects.edit');
    Route::delete('delete/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
});

Route::get('/{slug?}', [PageController::class, 'index'])
    ->where('slug', '.*')
    ->name('page.show');

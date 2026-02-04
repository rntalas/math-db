<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Locale;

class SubjectController extends Controller
{
    public function create()
    {
        $locales = Locale::all();
        return view('pages.subjects.create', compact('locales'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:255',
        ]);

        foreach ($validated['titles'] as $localeId => $title) {
            Subject::create([
                'title' => $title,
                'locale_id' => $localeId,
            ]);
        }

        return redirect()->route('page.show', ['slug' => '']);
    }

    public function show(Subject $subject) {
        return view('pages.subjects.view', compact('subject'));
    }

}

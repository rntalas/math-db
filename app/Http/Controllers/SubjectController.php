<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;

class SubjectController extends Controller
{
    public function create()
    {
        return view('pages.subjects.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Subject::create($validated);

        return redirect()->route('page.show', ['slug' => '']);
    }

    public function show(Subject $subject) {
        return view('pages.subjects.view', compact('subject'));
    }

}

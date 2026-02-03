<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Lesson;
use App\Models\Subject;

class PageController extends Controller
{
    public static string $title;

    public function index($slug = 'home')
    {
        $view = 'pages.'.($slug ?: 'home');

        if (! view()->exists($view)) {
            abort(404);
        }

        $title = ucfirst(str_replace('-', ' ', $slug ?: 'home'));

        $lessons = Lesson::all();
        $subjects = Subject::all();
        $entries = Entry::all();

        return view($view, compact('title', 'lessons', 'subjects', 'entries'));
    }
}

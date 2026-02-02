<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public string $title;

    public function __construct(?string $title = null)
    {
        $this->title = $title ?? 'Math DB';
    }

    public function render()
    {
        return view('components.layout');
    }
}

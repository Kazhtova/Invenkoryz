<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PerPageOption extends Component
{
    /**
     * Create a new component instance.
     */
    public $PerPageOption = [10, 25, 50, 10];
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.per-page-option');
    }
}
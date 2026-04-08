<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterByOptions extends Component
{
    /**
     * Create a new component instance.
     */
    public $options, $term, $defaultValue, $field;
    public function __construct($options, $term, $defaultValue = 'Pilih Option', $field)
    {
        $this->options = $options;
        $this->term = $term;
        $this->defaultValue = $defaultValue;
        $this->field = $field;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-by-options');
    }
}
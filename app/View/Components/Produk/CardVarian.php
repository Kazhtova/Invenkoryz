<?php

namespace App\View\Components\produk;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardVarian extends Component
{
    /**
     * Create a new component instance.
     */
    public $varian;
    public function __construct($varian)
    {
        $this->varian = $varian;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.produk.card-varian');
    }
}
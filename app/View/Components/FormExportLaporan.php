<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormExportLaporan extends Component
{
    /**
     * Create a new component instance.
     */
    public $jenisTransaksi;
    public function __construct($jenisTransaksi)
    {
        $this->jenisTransaksi = $jenisTransaksi;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-export-laporan');
    }
}
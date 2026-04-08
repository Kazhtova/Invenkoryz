<?php

namespace App\View\Components\StokOpname;

use App\Models\PeriodeStokOpname;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormPeriodeStokOpname extends Component
{
    /**
     * Create a new component instance.
     */
    public $tanggal_mulai, $tanggal_selesai, $id, $action, $is_active;
    public function __construct($id = null)
    {
        if($id){
            $periode = PeriodeStokOpname::findOrFail($id);
            $this->id = $periode->id;
            $this->tanggal_mulai = $periode->tanggal_mulai;
            $this->tanggal_selesai = $periode->tanggal_selesai;
            $this->action = route('stok-opname.periode.update', $periode->id);
        }else{
            $this->action = route('stok-opname.periode.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stok-opname.form-periode-stok-opname');
    }
}
<?php

namespace App\View\Components\KategoriProduk;

use App\Models\KategoriProduk;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormKategoriProduk extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $nama_kategori, $action;
    public function __construct($id = null)
    {
        if($id) {
            $kategori = KategoriProduk::findOrFail($id);
            $this->id = $kategori->id;
            $this->nama_kategori = $kategori->nama_kategori;
            $this->action = route("master-data.kategori-produk.update", $kategori->id);
        } else {
            $this->action = route('master-data.kategori-produk.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kategori-produk.form-kategori-produk');
    }
}
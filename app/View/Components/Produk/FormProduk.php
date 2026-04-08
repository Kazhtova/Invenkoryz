<?php

namespace App\View\Components\Produk;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormProduk extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $nama_produk, $deskripsi_produk, $kategori_produk_id, $kategori, $action;
    public function __construct($id = null)
    {
        $this->kategori = KategoriProduk::all();
        if ($id) {
            $produk = Produk::findOrFail($id);
            $this->id = $produk->id;
            $this->nama_produk = $produk->nama_produk;
            $this->deskripsi_produk = $produk->deskripsi_produk;
            $this->kategori_produk_id = $produk->kategori_produk_id;
            $this->action = route('master-data.produk.update', $produk->id);
        } else {
            $this->action = route('master-data.produk.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.produk.form-produk');
    }
}
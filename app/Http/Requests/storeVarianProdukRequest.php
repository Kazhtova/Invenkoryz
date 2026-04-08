<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeVarianProdukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produk_id'     => 'required|exists:produks,id',
            'nama_varian'   => 'required',
            'harga_varian'  => 'required|numeric|min:0',
            'stok_varian'   => 'required|numeric|min:0',
            'gambar_varian' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
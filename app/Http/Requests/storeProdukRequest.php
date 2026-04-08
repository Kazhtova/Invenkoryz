<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProdukRequest extends FormRequest
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
            'nama_produk'           => 'required|unique:produks,nama_produk',
            'deskripsi_produk'      => 'required|min:10',
            'kategori_produk_id'    => 'required|exists:kategori_produks,id'
        ];
    }

    public function messages():array
    {
        return [
          'nama_produk.required'            => 'Nama Produk Harus Diisi',
          'deskripsi_produk_.required'      => 'Deskripsi Produk Harus Diisi',
          'kategori_produk_id.required'     =>  'Kategori Produk Harus Diisi',
          'kategori_produk_id.exists'       => 'Kategori Produk Tidak Ditemukan',   
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriProdukRequest extends FormRequest
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
            'nama_kategori' => 'required|unique:kategori_produks,nama_kategori',
        ];
    }

    public function message():array
    {
        return [
          'required' => 'Nama Kategori Wajib Diisi',
          'unique'   => 'Nama Kategori Sudah Terpakai'  
        ];
    }
}
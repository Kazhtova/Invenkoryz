<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInputStokOpnameRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'produk'            => 'required',
            'nomor_sku'         => 'required',
            'jumlah_dilaporkan' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'produk.required'               => 'Produk Wajib Diisi',
            'nomor_sku.required'            => 'Nomor SKU Wajib Diisi',
            'jumlah_dilaporkan.required'    => 'Jumlah Dilaporkan Wajib Diisi',
            'jumlah_dilaporkan.numeric'     => 'Jumlah Dilaporkan Harus Berupa Angka',
            'jumlah_dilaporkan.min'         => 'Jumlah Dilaporkan Minimal 0'
        ];
    }
}
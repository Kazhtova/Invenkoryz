<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class storeTransaksiKeluarRequest extends FormRequest
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
            'penerima'      => 'required|string|max:255',
            'kontak'        => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
            'items'         => 'required|array|min:1'
        ];
    }

    public function messages():array
    {
        return [
            'penerima.required'     => 'Field Penerima Wajib Diisi.',
            'kontak.required'       => 'Field Kontak Wajib Diisi.',
            'items.required'        => 'Minimal Harus Ada Satu Produk Yang Ditambahkan Dalam Transaksi.',
        ];
    }
}
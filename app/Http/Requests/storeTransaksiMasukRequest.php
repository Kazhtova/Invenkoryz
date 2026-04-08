<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTransaksiMasukRequest extends FormRequest
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
            'pengirim'  => 'required',
            'kontak'    => 'required',
            'keterangan' => 'nullable|string',
            'items'     => 'required|array|min:1'
        ];
    }
    public function messages()
    {
        return [
            'pengirim'  => 'Pengirim Wajib Diisi',
            'kontak.required'   => 'Kontak Wajib Diisi',
            'items.required'    => 'Item Minimal 1'
        ];
    }
}
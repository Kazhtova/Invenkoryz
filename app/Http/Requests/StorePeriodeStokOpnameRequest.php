<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePeriodeStokOpnameRequest extends FormRequest
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
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
            'is_active'         => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return[
            'tanggal_mulai.required'        => 'Tanggal Mulai Wajib Diisi',
            'tanggal_selesai.required'      => 'Tanggal Selesai Wajib Diisi',
            'tanggal_selesai.after_or_equal'=> 'Tanggal Selesai Harus Selesai Tanggal Mulai',
            'is_active.required'            => 'Status Wajib Diisi'
        ];
    }
}
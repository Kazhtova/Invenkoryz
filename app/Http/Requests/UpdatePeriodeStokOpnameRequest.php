<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePeriodeStokOpnameRequest extends FormRequest
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
            'tangga_selesai'    => 'required|date|after_or_equal',
            'is_active'         => 'nullabel|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_mulai.required'        => 'Tanggal Mulai Wajib Diisi',
            'tanggal_selesai.required'      => 'Tanggal Selesai Wajib Diisi',
            'tanggal_selesai.after_or_equal'=> 'Tanggal Selesai Harus Setelah Tanggal Mulai',
            'is_active.boolean'             => 'Status Tidak Valid'
        ];
    }
}
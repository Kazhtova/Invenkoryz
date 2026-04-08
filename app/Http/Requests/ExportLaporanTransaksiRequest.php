<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportLaporanTransaksiRequest extends FormRequest
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
            'jenis_transaksi'       => 'required|in:pemasukan,pengeluaran',
            'tanggal_awal'          => 'required|date',
            'tanggal_akhir'         => 'required|date|after_or_equal:tanggal_awal'
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_transaksi.required'      => 'Jenis Transaksi Wajib Diisi',
            'jenis_transaksi.in'            => 'Jenis Transaksi Harus Berupa "Pemasukan" Atau Pengeluaran',
            'tanggal_awal.required'         => 'Tanggal Awal Wajib Diisi',
            'tanggal_awal.date'             => 'Tanggal Awal Harus Valid',
            'tanggal_akhir.required'        => 'Tanggal Akhir Wajib Diisi',
            'tanggal_akhir.date'            => 'Tanggak Akhir Harus Valid',
            'tanggal_akhir.after_or_equal'  => 'Tanggal Akhir Harus Sama Dengan Atau Setelah Tanggal Awal'
        ];
    }
}
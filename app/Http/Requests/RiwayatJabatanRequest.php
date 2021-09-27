<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiwayatJabatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_sk' => ['required'],
            'tgl_sk' => ['required'],
            'tgl_tmt' => ['required'],
            'diterbitkan' => ['required'],
            'pangkat' => ['required'],
            'induk_unit_kerja' => ['required'],
            'unit_organisasi' => ['required'],
            'jenis_jabatan' => ['required'],
            'jabatan' => ['required', 'array'],
            'keterangan_jabatan' => ['required'],
            'group_fungsional' => ['required'],
            'jabatan_fungsional_tertentu' => ['required'],
            'jabatan_fungsional_umum' => ['required'],
            'status_jabatan' => ['required'],
            'alasan_jabatan_sementara' => ['required'],
            'catatan' => ['required'],
        ];
    }
}

<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class InformasiPegawai extends FormRequest
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
                'nip' =>  ['unique:table_pegawai','required'].$this->input('nip'),
                // 'nama_pegawai' =>  'required',
                // 'tanggal_lahir' =>  'required',
                // 'email_kemensos' => 'required|unique:table_email,email_1|max:255'.$this->input('id_email'),
                // 'email_lain' => 'required|unique:table_email,email_2|max:255'.$this->input('id_email'),
         
        ];
    }
}

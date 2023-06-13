<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:7',
            'c_password' => 'required|same:password'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Nama Lengkap Tidak Boleh Kosong!',
            'phone.required' => 'Nomor Telepon Tidak Boleh Kosong!',
            'phone.unique' => 'Nomor Telepon Sudah Pernah Terdaftar Sebelumnya!',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.unique' => 'Email Sudah Pernah Terdaftar Sebelumya!',
            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Minimal Harus Memiliki 7 Karakter!',
            'c_password.required' => 'Konfirmasi Password Tidak Boleh Kosong!',
            'c_password.same' => 'Konfirmasi Password Harus Sama dengan Password!'
        ];
    }
}

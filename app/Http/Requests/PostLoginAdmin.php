<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostLoginAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // xac thuc
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // key cua mang chinh la gia tri cua thuoc tinh name cua the input trong form
        // value : ten cua cac rules ma laravel no dinh nghia
        return [
            'username' => 'required|email',
            'password' => 'required'
        ];
    }

    // custom error message
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    public function messages()
    {
        return [
            'username.required' => ':attribute khong duoc trong',
            'username.email' => ':attribute phai la mot dinh dang email',
            'password.required' => ':attribute khong duoc trong'
        ];
    }
}

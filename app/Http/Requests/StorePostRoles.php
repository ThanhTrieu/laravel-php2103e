<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRoles extends FormRequest
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
            'nameRole' => 'required|unique:roles,name',
            'displayNameRole' => 'required'
        ];
    }

    /**
     * show error messages
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'nameRole.required' => ':attribute khong duoc trong',
            'nameRole.unique' => ':attribute da ton tai, vui long chon :attribute khac',
            'displayNameRole.required' => ':attribute khong duoc trong'
        ];
    }
}

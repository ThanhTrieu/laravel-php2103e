<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostBrands extends FormRequest
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
            'name' => 'required|unique:brands,name',
            'logo' => 'required|mimes:jpg,png,jpeg'
        ];
    }

    /**
     * messages error
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ':attribute khong duoc trong',
            'name.unique' => ':attribute da ton tai vui long chon :attribute khac',
            'logo.required' => ':attribute khong duoc trong',
            'logo.mimes' => ':attribute phai la cac dinh dang jpg,png,jpeg'
        ];
    }
}

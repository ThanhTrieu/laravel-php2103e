<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditPostBrand extends FormRequest
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
    public function rules(Request $request)
    {
        $id = $request->id;
        return [
            'name' => 'required|unique:brands,name,'.$id
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
        ];
    }
}

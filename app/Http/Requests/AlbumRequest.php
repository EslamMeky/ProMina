<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:150',
            'desc'=>'required',
            'image'=>'required_without:id|mimes:jpg,jpeg,png,gif',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'This Field is required',

        ];
    }
}

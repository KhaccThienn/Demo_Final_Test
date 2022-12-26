<?php

namespace App\Http\Requests\People;

use Illuminate\Foundation\Http\FormRequest;

class AddPeopleRequest extends FormRequest
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
            'name' => "bail|required|min:3|max:100",
            'image' => 'bail|required|mimes:png,jpg,jpeg,webp,jfif',
            'birthday' => 'bail|required|date',
            'about' => 'bail|required'
        ];
    }
}

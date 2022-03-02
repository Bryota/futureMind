<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
            'industry' => 'required',
            'name' => 'required',
            'year' => 'required',
            'club' => 'required',
            'university' => 'required',
            'hobby' => 'required',
            'hometown' => 'required',
            'email' => 'required|email:filter',
        ];
    }
}

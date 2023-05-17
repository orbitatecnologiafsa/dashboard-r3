<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'cnpj' => 'required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cnpj.required' => 'O campo  email é obrigatorio!',
            'password.required' => 'O campo senha é obrigatorio!'
        ];
    }
}

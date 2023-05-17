<?php

namespace App\Http\Requests\Adm;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
        $roles = [
            'cnpj' => 'required',
            'password' => 'required',
            'nome_filial' => 'required'
        ];
        
        if ($this->method() == 'PUT'){
            $roles = [
                'cnpj' => 'required',
                'password' => 'nullable',
                'nome_filial' => 'required'
            ];
        }
        return $roles;
    }

    public function messages()
    {
        return [
            'cnpj.required' => 'O campo  cnpj ou cpf é obrigatorio!',
            'password.required' => 'O campo senha é obrigatorio!',
            'nome_filial.required' => 'O campo nome é obrigatorio!'
        ];
    }
}

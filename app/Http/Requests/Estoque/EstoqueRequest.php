<?php

namespace App\Http\Requests\Estoque;

use Illuminate\Foundation\Http\FormRequest;

class EstoqueRequest extends FormRequest
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
        $rules = [
            'busca_produto' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
          'busca_produto.required' => "O campo buscar produtos é obrigatorio"
        ];
    }
}

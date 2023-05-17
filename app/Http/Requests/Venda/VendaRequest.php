<?php

namespace App\Http\Requests\Venda;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
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
            "data_inicio" => "nullable|date",
            "data_fim" => "nullable|date"
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            "data_inicio.required" => "O campo inicio é obrigatório",
            "data_fim.required" => "O campo fim é obrigatório"
        ];
    }
}

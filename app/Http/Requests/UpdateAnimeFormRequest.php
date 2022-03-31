<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimeFormRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'new_season' => ['nullable', 'regex:/^[1-9][0-9]?$/']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome do Anime é obrigatório.',
            'name.min' => 'O campo Nome do Anime precisa de no minimo 2 caracteres.',
            'name.max' => 'O campo Nome do Anime precisa de no maximo 255 caracteres.',
            'new_season.regex' => 'O campo Nº de Temporadas deve ser um número entre 1-99'
        ];
    }
}

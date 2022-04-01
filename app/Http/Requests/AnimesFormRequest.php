<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimesFormRequest extends FormRequest
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
            'name' => 'required|unique:animes,name|min:2|max:255',
            'seasons_number' => ['required', 'regex:/^[1-9][0-9]?$/']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome do Anime é obrigatório.',
            'name.unique' => 'O campo Nome do Anime deve ser unico.',
            'name.min' => 'O campo Nome do Anime precisa de no minimo 2 caracteres.',
            'name.max' => 'O campo Nome do Anime precisa de no maximo 255 caracteres.',
            'seasons_number.required' => 'O campo Nº de Temporadas é obrigatório.',
            'seasons_number.regex' => 'O campo Nº de Temporadas deve ser um número entre 1-99'
        ];
    }
}

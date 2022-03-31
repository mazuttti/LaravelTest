<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SeasonsEpisodesFormRequest extends FormRequest
{
    private int $seasons_number;
    
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
        $this->seasons_number = $request->seasons_number;
        $rules = [];
        for($i = 1; $i <= $this->seasons_number; $i++) {
            $rules['season_' . $i . '_episodes'] = ['required', 'regex:/^[1-9][0-9]?$/'];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        for($i = 1; $i <= $this->seasons_number; $i++) {
            $messages['season_' . $i . '_episodes.required'] = 'O campo Nº de Episódios é obrigatório.';
            $messages['season_' . $i . '_episodes.regex'] = 'O campo Nº de Episódios deve ser um número entre 1-99';
        }
        return $messages;
    }
}

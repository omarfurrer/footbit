<?php

namespace App\Http\Requests\Tournament;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\TournamentTypes;

class StoreTournamentRequest extends FormRequest {

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
        $types = TournamentTypes::values();
        return [
            'name' => 'required|string|between:3,255',
            'type' => ['required', Rule::in($types)],
            'default_venue_id' => 'required|exists:venues,id',
            'number_of_teams' => 'required|integer',
            'players_per_team' => 'required|integer|between:5,12',
            'fees_per_team' => 'required|integer',
            'default_match_time' => 'required|integer',
            'min_age' => 'nullable|integer',
            'max_age' => 'nullable|integer|greater_than_field:min_age',
            'first_prize' => 'required|integer',
            'second_prize' => 'required|integer|less_than_field:first_prize',
            'third_prize' => 'required|integer|less_than_field:second_prize|required_if_attribute:number_of_teams,>,4',
        ];
    }

    /**
     * Array of validation messages.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'max_age.greater_than_field' => 'the :attribute needs to be bigger than the :other attribute.',
            'second_prize.less_than_field' => 'the :attribute needs to be smaller than the :other attribute.',
            'third_prize.less_than_field' => 'the :attribute needs to be smaller than the :other attribute.',
        ];
    }

}

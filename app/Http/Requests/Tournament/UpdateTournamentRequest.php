<?php

namespace App\Http\Requests\Tournament;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTournamentRequest extends FormRequest {

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
            'name' => '',
            'type' => '',
            'stage' => '',
            'fees_per_team' => '',
            'age_group' => '',
            'first_prize' => '',
            'second_prize' => '',
            'third_prize' => '',
            'default_match_time' => '',
            'default_venue_id' => ''
        ];
    }

}

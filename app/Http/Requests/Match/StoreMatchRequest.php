<?php

namespace App\Http\Requests\Match;

use Illuminate\Foundation\Http\FormRequest;

class StoreMatchRequest extends FormRequest
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
            'name'=>'nullable|string|between:3,255',
            'referee_id'=>'nullable|exists:referees,id',
            'starting_at'=>'nullable',
            'duration'=>'required|integer',
            'venue_id'=>'nullable|exists:venues,id',
            'court'=>'nullable',
            'first_team_id'=>'required|exists:teams,id',
            'second_team_id'=>'required|exists:teams,id|different:first_team_id',
        ];
    }
}

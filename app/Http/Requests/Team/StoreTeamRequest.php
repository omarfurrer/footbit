<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest {

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
            'name' => 'required|unique:teams|string|between:3,255',
            'moto' => 'nullable|string|between:3,255',
            'coach_id' => 'required|exists:players,id|in_array:players.*',
            'players' => 'array',
            'players.*' => 'exists:players,id'
        ];
    }

}

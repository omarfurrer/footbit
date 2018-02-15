<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Request;

class UpdateUserRequest extends FormRequest {

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
            'name' => 'required|string|between:3,255',
            'username' => ['required', 'string', 'between:3,255', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'phone_number' => ['numeric', 'nullable', Rule::unique('users')->ignore($this->user->id)],
            'date_of_birth' => 'date|nullable',
            'is_admin' => 'boolean'
        ];
    }

}

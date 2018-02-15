<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest {

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
            'username' => 'required|string|unique:users,username|between:3,255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'numeric|unique:users,phone_number',
            'date_of_birth' => 'date',
            'is_admin' => 'boolean'
        ];
    }

}

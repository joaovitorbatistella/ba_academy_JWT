<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            'email'    => 'required|email',
            'password' => 'required|string'
        ];
    }

    /***
     * Customize the error messages
     */
    public function messages()
    {
        return [
            'email.required'    => 'Email is required.',
            'email.email'       => 'Email in not in valid format.',
            'password.required' => 'Password is required.',
            'password.string'   => 'Password must be a string.',
        ];
    }
}

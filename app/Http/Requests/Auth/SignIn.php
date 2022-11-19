<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignIn extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255|unique:users,email',
            'name' => 'required|max:64',
            'sign_in_type' => 'required|in:default,gmail,linked-in',
            'gmailId' => 'required_if:sign_in_type,gmail',
            'linkedInId' => 'required_if:sign_in_type,linked-in',
            'password' => 'required_if:sign_in_type,default|max:255|confirmed',
            'role' => 'required_if:sign_in_type,default|max:32',
        ];
    }
}

<?php

namespace App\Http\Requests;

class RegistrationRequest extends BaseRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }

    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Your name is required for registration',
            'email.required' => 'Your email is required for registration',
            'email.unique' => 'Sorry, that email is already in our system!',
            'password.required' => 'Your password is required for registration'
        ];
    }
}

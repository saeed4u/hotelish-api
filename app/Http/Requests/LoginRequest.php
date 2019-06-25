<?php

namespace App\Http\Requests;


class LoginRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Auth not required for login
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
            'email' => 'required|email',
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
            'email.required' => 'Your email is required to login',
            'password.required' => 'Your password is required to login'
        ];
    }

}

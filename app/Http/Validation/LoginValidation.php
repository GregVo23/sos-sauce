<?php

namespace App\Http\Validation;


class LoginValidation
{
    public function rules()
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il manque votre nom',
            'password.required' => 'Il manque votre password'
        ];
    }
}

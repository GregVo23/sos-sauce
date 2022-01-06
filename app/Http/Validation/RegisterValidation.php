<?php

namespace App\Http\Validation;


class RegisterValidation
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:150', 'min:3', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
            'agreed' => ['accepted']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il manque votre nom',
            'email.required' => 'Il manque votre email',
            'password.required' => 'Il manque votre password',
            'confirm_password.required' => 'Il manque la conffirmation de password',
            'agreed.required' => 'Vous devez acceptez les règles'
        ];
    }
}

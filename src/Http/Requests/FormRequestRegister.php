<?php

namespace TypiCMS\Modules\Users\Http\Requests;

use TypiCMS\Modules\Core\Shells\Http\Requests\AbstractFormRequest;

class FormRequestRegister extends AbstractFormRequest
{
    public function rules()
    {
        $rules = [
            'email'                 => 'required|email|max:255|unique:users',
            'first_name'            => 'required|max:255',
            'last_name'             => 'required|max:255',
            'password'              => config('auth.optional_password') ? 'min:8|max:255' : 'required|min:8|max:255|confirmed',
            'password_confirmation' => config('auth.optional_password') ? '' : 'required',
        ];

        return $rules;
    }
}

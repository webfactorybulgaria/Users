<?php

namespace TypiCMS\Modules\Users\Http\Requests;

use TypiCMS\Modules\Core\Custom\Http\Requests\AbstractFormRequest;

class FormRequestLogin extends AbstractFormRequest
{
    public function rules()
    {
        return [
            'email'      => 'required|email|max:255',
            'password'   => 'required|max:255',
        ];
    }
}

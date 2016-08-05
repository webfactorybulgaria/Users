<?php

namespace TypiCMS\Modules\Users\Http\Requests;

use TypiCMS\Modules\Core\Custom\Http\Requests\AbstractFormRequest;

class FormRequestEmail extends AbstractFormRequest
{
    public function rules()
    {
        $rules = [
            'email' => 'required|email|max:255',
        ];

        return $rules;
    }
}

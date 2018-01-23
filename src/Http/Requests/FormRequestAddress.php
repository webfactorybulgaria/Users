<?php

namespace TypiCMS\Modules\Users\Http\Requests;

use TypiCMS\Modules\Core\Shells\Http\Requests\AbstractFormRequest;

class FormRequestAddress extends AbstractFormRequest
{
    public function rules()
    {
        $rules = [
            'contact_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required',
        ];

        return $rules;
    }
}

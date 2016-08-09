{!! BootForm::hidden('id') !!}
{!! BootForm::text(trans('users::global.attributes.country'), 'country') !!}
{!! BootForm::text(trans('users::global.attributes.city'), 'city') !!}
{!! BootForm::text(trans('users::global.attributes.address'), 'address') !!}
{!! BootForm::text(trans('users::global.attributes.address2'), 'address2') !!}
{!! BootForm::text(trans('users::global.attributes.postcode'), 'postcode') !!}
{!! BootForm::submit(trans('validation.attributes.save'))->class('btn btn-primary') !!}
@include('core::admin._message', ['closable' => false])

<h1>@lang('users::global.Register')</h1>

{!! BootForm::email(trans('validation.attributes.email'), 'email')->addClass('input-lg') !!}
{!! BootForm::text(trans('validation.attributes.first_name'), 'first_name')->addClass('input-lg') !!}
{!! BootForm::text(trans('validation.attributes.last_name'), 'last_name')->addClass('input-lg') !!}
{!! BootForm::password(trans('validation.attributes.password'), 'password')->addClass('input-lg') !!}
{!! BootForm::password(trans('validation.attributes.password_confirmation'), 'password_confirmation')->addClass('input-lg') !!}

<div class="form-group form-action">
    {!! BootForm::submit(trans('validation.attributes.register'), 'btn-primary')->addClass('btn-lg btn-block') !!}
</div>
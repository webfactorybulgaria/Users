@extends('core::admin.master')

@section('title', trans('users::global.Log in'))

@section('page-header')
@endsection
@section('sidebar')
@endsection
@section('mainClass')
@endsection
@section('errors')
@endsection

@section('main')

<div id="login" class="container-login container-xs-center">

    @include('core::admin._message', ['closable' => false])

    {!! BootForm::open() !!}

        <h1>@lang('users::global.Log in')</h1>

        <div class="form-group">
            {!! Form::email('email')->addClass('form-control input-lg')->placeholder(trans('validation.attributes.email'))->autofocus(true) !!}
        </div>
        <div class="form-group">
            {!! Form::password('password')->addClass('form-control input-lg')->placeholder(trans('validation.attributes.password')) !!}
        </div>

        <div class="form-group">
            {!! BootForm::checkbox(trans('users::global.Remember me'), 'remember') !!}
        </div>

        <div class="form-group">
            {!! BootForm::submit(trans('validation.attributes.log in'), 'btn-primary')->addClass('btn-lg btn-block') !!}
        </div>

        <div class="form-group">
            <span class="help-block">
                <a href="{{ route('resetpassword') }}">@lang('users::global.Forgot your password?')</a>
            </span>
        </div>

        @if (config()->get('auth.social_users'))
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-lg waves-effect waves-light btn-block google">Google+</a>
            </div>
        </div>
        @endif

    {!! BootForm::close() !!}

</div>

@endsection

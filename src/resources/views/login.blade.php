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
{!! BootForm::open() !!}
    @include('users::_form-login')
{!! BootForm::close() !!}
</div>

@endsection

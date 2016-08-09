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

<div id="profile" class="container-profile container-xs-center">
    {!! BootForm::open()->action(route('storeAddress-profile'))->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('users::public._form-address')
    {!! BootForm::close() !!}
</div>

@endsection

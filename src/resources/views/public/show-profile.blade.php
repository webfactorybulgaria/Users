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
    user's profile page

    <h2>User addresses</h2>
    @if($user->addresses)
        @include('users::public._address-list', ['addresses' => $user->addresses])
    @endif
    <a href="{{ route('createAddress-profile') }}">@lang('db.Add new address')</a>
</div>

@endsection

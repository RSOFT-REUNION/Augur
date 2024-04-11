@extends('frontend.layouts.layout')
@section('title', __('Connexion') )

@section('main-content')

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        {{ __("You're logged in!") }}
    </h2>
    <a href="{{ route('profile.edit') }}"  class="btn btn-primary">{{ __('Profile') }}</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">{{ __('Log Out') }}</button>
    </form>

@endsection

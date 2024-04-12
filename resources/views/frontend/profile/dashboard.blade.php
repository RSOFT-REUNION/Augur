@extends('frontend.layouts.layout')
@section('title', __('Connexion') )

@section('main-content')

    <h3>Bonjour {{ Auth::user()->name }} {{ Auth::user()->last_name }}</h3>
    <a href="{{ route('profile.edit') }}"  class="btn btn-primary">{{ __('Profile') }}</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger">{{ __('Log Out') }}</button>
    </form>

@endsection

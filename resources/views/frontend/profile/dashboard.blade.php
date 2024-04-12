@extends('frontend.layouts.layout')
@section('title', __('Connexion') )

@section('main-content')

    <h3>Bonjour {{ Auth::user()->name }} {{ Auth::user()->first_name }}</h3>

@endsection

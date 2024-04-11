@extends('frontend.layouts.layout')
@section('title', __('Connexion') )

@section('main-content')
    <div class="row row-flex">
        <div class="col-12 col-md-6 content">
            @include('frontend.auth.loginform')
        </div>
        <div class="col-12 col-md-6 content">
            @include('frontend.auth.register')
        </div>
    </div>
@endsection

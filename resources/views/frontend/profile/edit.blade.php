@extends('frontend.layouts.layout')
@section('title', __('Bienvenue') )

@section('main-content')

<div class="row row-flex">
    <div class="col-12 col-md-6 align-self-center">
        @include('frontend.profile.partials.update-profile-information-form')
    </div>
    <div class="col-12 col-md-6 align-self-center">
        @include('frontend.profile.partials.update-password-form')
        @include('frontend.profile.partials.newsletter')
    </div>
</div>

@endsection

@extends('frontend.layouts.layout')
@section('title', __('Bienvenue') )

@section('main-content')

<div class="row row-flex">
    <div class="col-12 col-md-8">
        @include('frontend.profile.partials.update-profile-information-form')
    </div>
    <div class="col-12 col-md-4">
        @include('frontend.profile.partials.update-password-form')
    </div>
</div>

@endsection

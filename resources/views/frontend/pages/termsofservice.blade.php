@extends('frontend.layouts.layout')
@section('title', __('Conditions générales d\'utilisation') )

@section('main-content')
    {!! $termsofservice->termsofservice !!}
@endsection

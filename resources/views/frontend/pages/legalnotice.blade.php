@extends('frontend.layouts.layout')
@section('title', __('Mentions légales') )

@section('main-content')
    {!! $legalnotice->legalnotice !!}
@endsection

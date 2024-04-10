@extends('frontend.layouts.layout')
@section('title', __('Bienvenue') )

@section('main-content')

    Site Front

    Infos : {!! $infos->address !!} <br>
    {!! $page->content !!}

@endsection

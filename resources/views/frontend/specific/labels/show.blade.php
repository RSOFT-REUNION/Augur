@extends('frontend.layouts.layout')

@section('title', $label->name)

@section('main-content')

    <h1 class="text-center">{{ $label->name }}</h1>
    <div class="text-center">
        <img src="/storage/upload/specific/labels/{{ $label->image }}" class="mb-3 p-3" alt="{{ $label->image }}">
    </div>
    {!! $label->description !!}

@endsection

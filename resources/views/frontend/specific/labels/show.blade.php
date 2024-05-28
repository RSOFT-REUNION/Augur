@extends('frontend.layouts.layout')

@section('title', $label->name)

@section('main-content')

    <div data-aos="fade-up" class="text-end mb-5">
        <a href="{{ route('labels.index') }}" class="btn btn-primary hvr-grow-shadow"><i class="fa-solid fa-arrow-rotate-left"></i> Retour à la liste</a>
    </div>

    <div class="row row-flex align-items-center">
        <div class="col-12 col-md-6" data-aos="flip-left">
            <h1 class="text-center ">{{ $label->name }}</h1>
        </div>
        <div class="col-12 col-md-6" data-aos="flip-left">
            <div class="text-center">
                <img src="{{ getImageUrl('/upload/specific/labels/'.$label->image, 200, 200, 'fill-max') }}" class="mb-3 p-3" alt="{{ $label->image }}">
            </div>
        </div>
    </div>
    <div data-aos="zoom-out-up">
        {!! $label->description !!}
    </div>
@endsection

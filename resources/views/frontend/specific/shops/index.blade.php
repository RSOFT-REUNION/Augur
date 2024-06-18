@extends('frontend.layouts.layout')

@section('title', 'Liste de nos magasins')

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Nos magasins</li>
            </ol>
        </nav>
    </div>

    <div class="text-center" data-aos="fade-left">
        <h1 class="mb-3">Nos magasins</h1>
    </div>

    @foreach($shops as $shop)
        <div class="row  align-items-center">
            <div class="col-4">
                <img src="{{ getImageUrl('/upload/catalog/shops/'.$shop->image, 500, 500, 'fill-max') }}" class="img-fluid " alt="{{ $shop->image }}">
            </div>
            <div class="col-8">
                <h1 class="mb-3">{{ $shop->name }}</h1>
                <h4 class="mb-3">{{ $shop->address .' '. $shop->postal_code .' - '. $shop->city }}</h4>
                <p class="mb-3">{{ $shop->description }}</p>
                <h5 class="mb-3">Nos horaires</h5>
                <p>{{ $shop->schedules }}</p>
            </div>
            <hr>
        </div>
    @endforeach

@endsection

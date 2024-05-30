@extends('frontend.layouts.layout')

@section('title', $label->name)

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('labels.index') }}">Nos labels</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $label->name }}</li>
            </ol>
        </nav>
    </div>

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
    <div data-aos="zoom-out-up" class="mb-5">
        {!! $label->description !!}
    </div>

    <div data-aos="fade-up" class="mb-5">
        <h2 class="mb-3">Découvrez les produits de ce label</h2>
        @if(count($products) > 0)
            <div class="row row-flex" id="list_product">
                @foreach($products as $product)
                    <div class="col-md-2 col-12 hvr-float-shadow">
                        @include('frontend.product.partials.products-card_small')
                    </div>
                @endforeach
            </div>
        @else
            <h3>Aucun produit ne correspond</h3>
        @endif
    </div>


@endsection

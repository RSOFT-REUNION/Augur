@extends('layouts.frontend')

@section('content-template')
    <div class="container mx-auto">
        <div class="">
            <a href="{{ route('fo.products') }}" class="btn-filled_secondary"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="flex items-center">
            <div class="flex-1">
                <div class="force-center">
                    <img src="{{ asset('storage/products/'. $product->picture) }}" width="500px"/>
                </div>
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold">{{ $product->title }}</h1>
                <p>{{ $product->description }}</p>
                <div class="mt-5">
                    <h2 class="text-primary font-bold text-xl">Les labels</h2>
                    <div class="inline-flex items-center mt-5">
                        @foreach($product->getLabelLink() as $product_label)
                            @if($product_label)
                                <a href="{{ route('fo.label', ['slug' => $product_label->slug]) }}"><img src="{{ asset('storage/medias/'. $product_label->getPicture()) }}" width="150px"/></a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

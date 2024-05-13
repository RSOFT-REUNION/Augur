@extends('frontend.layouts.layout')

@section('title', $produit->name)

@section('main-content')

    <div class="row">
        <div class="col-md-5 col-12">
            @foreach($produit->images as $image)
                @if($image->id == $produit->fav_image)
                    <img src="{{ $image->getImageUrl() }}" class="img-fluid" alt="{{ $produit->name }}">
                @endif
            @endforeach
        </div>
        <div class="col-md-7 col-12">
            <h2 class="text-center mb-3 text-decoration-underline">{{ $produit->name }}</h2>
            <h1 class="text-center mb-3">{{ formatPriceToFloat($produit->price_ttc) }} €</h1>
            <p>Stock : {{ $produit->stock }}</p>
            <h4>Description du produit :</h4>
            <p>{{ $produit->description }}</p>
            <div class="text-center">
                <img src="/storage/upload/specific/labels/100.la.reunion.png" class="w-25 mb-3 p-3" alt="100.la.reunion.png">
            </div>
            <div class="text-center">
                @if($produit->stock > 0)
                    <form>  @csrf
                        <button type="button" class="btn btn-primary btn-lg hvr-grow-shadow " id="add_cart"
                                hx-post="{{ route('cart.add_product', $produit) }}"
                                hx-target="#nb_produit"
                                hx-swap="outerHTML">Ajouter au panier
                        </button>
                    </form>
                @else
                    <button type="button" class="btn btn-danger" disabled>En rupture de stock</button>
                @endif
            </div>

        </div>
    </div>





@endsection

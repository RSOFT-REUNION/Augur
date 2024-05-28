@extends('frontend.layouts.layout')
@section('title', __('Bienvenue') )

@section('main-content')

    <div class="row row-flex mb-5">
        <h5>Affiche 6 produits aleatoire</h5>
        @foreach($products_random as $product)
            <div class="col-md-2 col-12">
                <div class="card content">
                    <a href="{{ route('product.show', $product->slug) }}">
                        <img src="{{ $product->getFirstImagesURL(350, 350, 'fill-max') }}" class="d-block w-100" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Stock : {{ formatStockToFloat($product->stock) }}</p>
                        @if($product->stock > 0)
                            <form>  @csrf
                                <button type="button" class="btn btn-primary " id="add_cart"
                                        hx-post="{{ route('cart.add_product', $product) }}"
                                        hx-target="#nb_produit"
                                        hx-swap="outerHTML">Ajouter au panier
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>En rupture de stock</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {!! $page->content !!}

    <!-- List des favoris -->
    @include('frontend.specific.labels.home')

@endsection

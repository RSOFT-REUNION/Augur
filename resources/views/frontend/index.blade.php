@extends('frontend.layouts.layout')
@section('title', __('Bienvenue') )

@section('main-content')

    <!--- List des produits --->
    <div class="row row-flex">
        @foreach($produits as $produit)
            <div class="col-md-4 col- mb-3">
                <div class="card hvr-grow-shadow content">
                    @foreach($produit->images as $image)
                        @if($image->id == $produit->fav_image)
                            <a href="{{ route('product.show', ['slug' => $produit->slug, 'product' => $produit]) }}">
                            <img src="{{ $image->getImageUrl() }}" class="d-block w-100" alt="{{ $produit->name }}">
                            </a>
                        @endif
                    @endforeach
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ $produit->name }}</h4>
                        <!--<p class="card-text">{{ $produit->description }}</p>-->
                        <h3 class="card-text  text-center">{{ $produit->price_ttc }} €</h3>
                    </div>
                        <div class="card-footer p-3 text-center">
                            @if($produit->stock > 0)
                                <form>  @csrf
                                    <button type="button" class="btn btn-primary " id="add_cart"
                                            hx-post="{{ route('cart.add_product', $produit) }}"
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

@endsection

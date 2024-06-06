@extends('frontend.layouts.layout')
@section('title', __('Bienvenue') )

@section('main-content')

    {!! $page->content !!}

    <div class="row row-flex mb-5">
        <h4 class="mb-4">Affiche 6 produits aleatoire</h4>
        @if(count($products_random) > 0)
            @foreach($products_random as $product)
                <div class="col-md-2 col-12 hvr-float-shadow">
                    @include('frontend.product.partials.products-card_small')
                </div>
                @if (!Cookie::has('session_id'))
                    @include('frontend.carts.partials.select_slot_modal')
                @endif
            @endforeach
        @else
            <h3>Aucun produit ne correspond</h3>
        @endif
    </div>

    <!-- List des favoris -->
    @include('frontend.specific.labels.home')

@endsection

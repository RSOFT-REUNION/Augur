@extends('frontend.layouts.layout')
@section('title', __('Récapitulatif de la commande') )

@section('main-content')

    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Récapitulatif de la commande</li>
            </ol>
        </nav>
    </div>

    <div class="row d-flex justify-content-between align-items-center text-center">
        <div class="col-md-3">

        </div>
        <div class="col-md-4">
            Désignation
        </div>
        <div class="col-md-2">
            Prix TTC
        </div>
        <div class="col-md-1">
            Quantité
        </div>
        <div class="col-md-2">
            Total
        </div>
    </div>

    <hr>
    @foreach($cart->product as $product)
        <div class="row d-flex justify-content-between align-items-center mt-3 mb-3 text-center">
            <div class="col-md-3">
                <img src="{{ getImageUrl(removeStorageFromURL($product->fav_image), 200, 200, 'fill-max') }}" class="w-50" alt="{{ $product->name }}">
            </div>
            <div class="col-md-4">
                <p class="lead fw-normal mb-2">{{ getProductInfos($product->product_id)->name  }}</p>
            </div>
            <div class="col-md-2">
                @if($product->discount_id)
                    <h6 class="text-decoration-line-through text-danger">{{ formatPriceToFloat($product->price_ttc) }} €</h6>
                    <h5 class="m-3">{{ formatPriceToFloat($product->price_ttc - ($product->price_ttc * $discountProducts[getProductInfos($product->product_id)->id]) / 100) }} €</h5>
                @else
                    <h5 class="mb-0">{{ formatPriceToFloat($product->price_ttc) }} €</h5>
                @endif
            </div>
            <div class="col-md-1">
                <b>{{ $product->quantity }}</b>
            </div>
            <div class="col-md-2">
                @if($product->discount_id)
                    <h6 class="text-decoration-line-through text-danger">{{ formatPriceToFloat($product->price_ttc) }} €</h6>
                    <h5 class="m-3">{{ formatPriceToFloat($product->price_ttc - ($product->price_ttc * $discountProducts[getProductInfos($product->product_id)->id]) / 100) }} €</h5>
                @else
                    <h5 class="mb-0">{{ formatPriceToFloat($cart->priceProductQuantity($product->id)) }} €</h5>
                @endif
            </div>
        </div>
        <hr>
    @endforeach

<div class="row row-flex justify-content-center">
    <div class="col-md-4 col-12">
        <div class="card bg-gray content">
            <div class="card-body">
                <div class="text-center">
                    <img class="w-25 mb-3" src="{{ asset('frontend/images/location.png') }}">
                </div>
                <h5>{{ $user_address->alias }}</h5>
                <p>{{ $user_address->name }} -
                    {{ $user_address->address }}
                    {{ $user_address->address2 }}
                    <br>
                    @foreach($cities as $city)
                        @if($city->postal_code == $user_address->cities)
                            {{ $city->postal_code }} - {{ $city->city }}
                        @endif
                    @endforeach
                    - {{ $user_address->country }}
                    <br>
                    Téléphone : {{ $user_address->phone }}
                    @if($user_address->other_phone)
                        / {{ $user_address->other_phone }}
                    @endif
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-12">
        <div class="card bg-gray content">
            <div class="card-body">
                <div class="row align-items-center text-center">
                    <div class="text-center">
                        <img class="w-25 mb-3 mt-3" src="{{ getImageUrl(('/upload/order/delivery/'.$deliver->image), 100, 100) }}" alt="{{ $deliver->name }}">
                    </div>
                    <h4 class="flex-fill">{{ $deliver->name }}</h4>
                    <h2 class=""><b>@if($deliver->price_ttc == 0) <b>Gratuit</b> @else {{ $deliver->price_ttc }} €@endif</b></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-12">
        @if($loyality == 0)
            <div class="card bg-warning content">
                <div class="card-body">
                    <div class="text-center">
                        <img class="w-50 mb-3 mt-3" src="{{ asset('frontend/images/discount.png') }}">
                        <h2 class="mx-auto"> 0 <i class="fa-solid fa-percent"></i></h2>
                        <p>Aucun point de fidélité ne sera utilisé.</p>
                    </div>
                </div>
            </div>
        @elseif($loyality == 5)
            <div class="card bg-warning content">
                <div class="card-body">
                    <div class="text-center">
                        <img class="w-50 mb-3 mt-3" src="{{ asset('frontend/images/discount.png') }}">
                        <h2 class="mx-auto">- 5 <i class="fa-solid fa-percent"></i></h2>
                        <p><b>300</b> point de fidélité seront utilisé.</p>
                    </div>
                </div>
            </div>
        @elseif($loyality == 10)
            <div class="card bg-warning content">
                <div class="card-body">
                    <div class="text-center">
                        <img class="w-50 mb-3 mt-3" src="{{ asset('frontend/images/discount.png') }}">
                        <h2 class="mx-auto">- 10 <i class="fa-solid fa-percent"></i></h2>
                        <p><b>500</b> point de fidélité seront utilisé.</p>
                    </div>
                </div>
            </div>
        @elseif($loyality == 15)
            <div class="card bg-warning content">
                <div class="card-body">
                    <div class="text-center">
                        <img class="w-50 mb-3 mt-3" src="{{ asset('frontend/images/discount.png') }}">
                        <h2 class="mx-auto">- 15 <i class="fa-solid fa-percent"></i></h2>
                        <p><b>1 000</b> point de fidélité seront utilisé.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

    <div class="p-3">
        <h2 id="sous-total" class="text-end mt-4">Sous-total ({{ $cart->countProduct() }} article(s)) :  {{ formatPriceToFloat($cart->countProductsPrice($deliver->price_ttc, $loyality)) }} €</h2>
        @if($loyality == 10)
            <h4 class="text-end">Une remise de 10% est appliquée à un montant de {{ formatPriceToFloat($cart->countProductsPrice($deliver->price_ttc, 0)) }} €.</h4>
        @endif
        <p class="text-end" >Le total de la commande inclut la TVA.</p>
    </div>

    <div class="text-center">
            <button type="submit" class="btn btn-lg btn-success hvr-grow-shadow"><i class="fa-regular fa-credit-card fa-2x"></i><br>Payer ma commande</button>
    </div>

@endsection

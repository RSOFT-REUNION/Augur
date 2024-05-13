@extends('frontend.layouts.layout')
@section('title', __('Récapitulatif de commande') )

@section('main-content')

<h3 class="mb-4">Récapitulatif de commande</h3>
@foreach($cart->product as $product)
    <div class="card rounded-3 mb-4">
        <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-3">
                    {{ $product->getFristImages($product) }}
                </div>
                <div class="col-md-3">
                    <p class="lead fw-normal mb-2">{{ getProductInfos($product->product_id)->name  }}</p>
                </div>
                <div class="col-md-2">
                    <p>Quantité</p><br>
                    <h5 class="mb-0">{{ $product->quantity }}</h5>
                </div>
                <div class="col-md-2">
                    <p>Prix TTC</p><br>
                    <h5 class="mb-0">{{ $product->price_ttc }} €</h5>
                </div>
                <div class="col-md-2">
                    <p>Total TTC</p><br>
                    <h5 class="mb-0">{{ $cart->priceProductQuantity($product->id) }} €</h5>
                </div>
            </div>
        </div>
    </div>
@endforeach

    <h5>Mon adresse de livraison : ({{ $user_address->alias }})</h5>
    <p>{{ $user_address->first_name }} {{ $user_address->last_name }} -
        {{ $user_address->address }}
        {{ $user_address->address2 }}
        {{ $user_address->city }} - {{ $user_address->postal_code }}
        {{ $user_address->country }}
        {{ $user_address->phone }}
        {{ $user_address->other_phone }}</p>

<h5>Livraison : {{ $deliver["name"] }} - @if($deliver->price_ttc == 0) Gratuit @else {{ $deliver->price_ttc }} €@endif</h5>

<h5 id="sous-total" class="text-end p-3">Sous-total ({{ $cart->countProduct() }} article) : {{ $cart->total_ttc }} €</h5>
<p class="text-end" style="margin-top: -20px;">Le total de la commande inclut la TVA.</p>

<form action="#" method="POST" id="payment-form" class="datpayment-form mb-5">
    <div class="dpf-title">
        Paiement par carte bancaire
        <div class="accepted-cards-logo"></div>
    </div>
</form>

@endsection

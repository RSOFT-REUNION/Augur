@extends('backend.layouts.layout')
@section('title', 'Details de la commande : '.$order->ref_order)

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card  border-left-danger shadow mb-4">
                <div class="row text-center align-items-center">
                    <div class="col-3">
                        <div class="m-3 text-secondary">
                            <i class="fa-duotone fa-calendar fa-3x"></i><br><h4>{{ formatDateInFrench($order->created_at->format('Y-m-d')) .' '. $order->created_at->format('H:i') }}</h4>
                        </div>
                    </div>
                    <div class="col-3 text-success"><i class="fa-solid fa-money-check-dollar fa-3x"></i><br><h3>{{ formatPriceToFloat($order->total_ttc) }} €</h3></div>
                    <div class="col-3 text-dark"><i class="fa-duotone fa-clipboard-list-check fa-3x mb-2"></i><br><h4>{{ $order->getStatus() }}</h4></div>
                    <div class="col-3 text-warning"><i class="fa-duotone fa-list fa-3x "></i><br><h3>{{ count($order->product) }}</h3></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Livraison</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <p>Mode de livraison : <b>{{ $order->getDeliverName() }}</b></p>
                        <p>Frais de livraison : <b>@if($order->delivery_price == 0) Gratuit @else {{ $order->delivery_price }} €  @endif</b></p>
                        @if($order->delivery_id == 2)
                            <p>Date de livraison : <b>{{ formatDateInFrench($order->delivery_date) }}</b><br>
                            Heure de livraison :  <b>@if($order->delivery_date == 'matin') Entre 9h et 13h @else Entre 14h et 18h @endif </b></p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card border-left-dark shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Client ({{ $order->user_name }} - {{ $order->user_email }})</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4>Adresse facturation</h4>
                            <p>{{ $order->user_civilite .' '. $order->user_name }}<br>
                            {{ $order->user_delivery_address }}<br>
                            @if($order->user_delivery_address2)
                                {{ $order->user_delivery_address2 }}<br>
                            @endif
                            {{ $order->user_delivery_cities }} - {{ $order->getCity() }}<br>
                            {{ $order->user_delivery_phone }}</p>
                        </div>
                        @if($order->delivery_id == 2)
                            <div class="col border-left-dark">
                                <h4>Adresse de livraison</h4>
                                @empty(!$order->user_invoice_address)
                                    <p>{{ $order->user_invoice_civilite .' '. $order->user_invoice_first_name .' '. $order->user_invoice_last_name }}<br>
                                        {{ $order->user_invoice_address }}<br>
                                        @if($order->user_invoice_address2)
                                            {{ $order->user_invoice_address2 }}<br>
                                        @endif
                                        {{ $order->user_invoice_cities }} - {{ $order->getInvoiceCity() }}<br>
                                        {{ $order->user_invoice_phone }}</p>
                                @else
                                    <p>{{ $order->user_civilite .' '. $order->user_name }}<br>
                                        {{ $order->user_delivery_address }}<br>
                                        @if($order->user_delivery_address2)
                                            {{ $order->user_delivery_address2 }}<br>
                                        @endif
                                        {{ $order->user_delivery_cities }} - {{ $order->getCity() }}<br>
                                        {{ $order->user_delivery_phone }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-warning shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Liste des produits</h6>
                </div>

                <div class="card-body">
                        <div class="row d-flex justify-content-between align-items-center text-center">
                            <div class="col-md-1">

                            </div>
                            <div class="col-md-5">
                                Nom
                            </div>
                            <div class="col-md-4">
                                Quantité
                            </div>
                            <div class="col-md-2">
                                Prix TTC
                            </div>
                        </div>
                        <hr>
                        @foreach($order->product as $product)
                            <div class="row d-flex justify-content-between align-items-center text-center">
                                <div class="col-md-1">
                                    <img src="{{ getImageUrl(removeStorageFromURL($product->fav_image), 200, 200, 'fill-max') }}" class="w-50" alt="{{ $product->name }}">
                                </div>
                                <div class="col-md-5">
                                    {{ $product->name }}
                                </div>
                                <div class="col-md-4">
                                    {{ $product->quantity }}
                                </div>
                                <div class="col-md-2">
                                    <b>{{ formatPriceToFloat($product->price_ttc) }} €</b>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection

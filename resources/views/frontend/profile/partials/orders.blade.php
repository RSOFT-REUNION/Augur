@extends('frontend.profile.dashboard')
@section('title', __('Mes commandes') )


@section('dashboard-breadcrumb')
    <div style="margin-top: 60px;" class="mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-nav mt-5 p-3 rounded-3 shadow">
                <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Mon compte</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Mes commandes</li>
            </ol>
        </nav>
    </div>
@endsection

@section('dashboard-content')
    <div class="text-end mb-4">
        <a class="hvr-grow-shadow btn btn-warning" href="{{ route('dashboard') }}"><i class="fa-solid fa-circle-left"></i> Retour</a>
    </div>

    <h2>Mes commandes</h2>

    <div class="row d-flex justify-content-between align-items-center text-center">
        <div class="col-md-3">
            Date
        </div>
        <div class="col-md-4">
            Réference
        </div>
        <div class="col-md-2">
            Total TTC
        </div>
        <div class="col-md-1">
            Status
        </div>
        <div class="col-md-2">
            Détails
        </div>
    </div>
    <hr>

    @foreach($orders as $order)
        <div class="row d-flex justify-content-between align-items-center text-center">
            <div class="col-md-3">
                {{ formatDateInFrench($order->created_at->format('Y-m-d')) }}
            </div>
            <div class="col-md-4">
                {{ $order->ref_order }}
            </div>
            <div class="col-md-2">
                <b>{{ formatPriceToFloat($order->total_ttc) }} €</b>
            </div>
            <div class="col-md-1">
                {{ $order->getStatus() }}
            </div>
            <div class="col-md-2">
                <button class="btn btn-warning rounded-5 text-end" data-bs-toggle="modal" data-bs-target="#order{{ $order->id }}"><i class="fa-solid fa-circle-info"></i></button>
            </div>
        </div>
        <hr>

        <!-- Modal -->
        <div class="modal fade" id="order{{ $order->id }}" tabindex="-1" aria-labelledby="order{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">{{ $order->ref_order }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h3 class="text-center">{{ $order->getStatus() }}</h3>

                        <div class="row d-flex justify-content-between align-items-center text-center">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-4">
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
                                <div class="col-md-2">
                                    <img src="{{ getImageUrl(removeStorageFromURL($product->fav_image), 200, 200, 'fill-max') }}" class="w-50" alt="{{ $product->name }}">
                                </div>
                                <div class="col-md-4">
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

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="card">
                                    <div class="card-body bg-gray">
                                        <div class="row">
                                            <div class="text-end col-4">Mode de livraison :</div>
                                            <div class="text-start col-8">
                                                <p> @if($order->delivery_id == 1 ) Clic & Collect @elseif($order->delivery_id == 2) Liv'Express @endif
                                                    <b> - @if($order->delivery_price == 0) <b>Gratuit</b> @else {{ $order->delivery_price }} €@endif</b><br>
                                                    @empty(!@$order->delivery_date)
                                                        {{ formatDateInFrench($order->delivery_date) }} :
                                                        @if($order->delivery_slot == 'matin') Entre 9h et 13h @elseif($order->delivery_slot == 'aprem') Entre 14h et 18h @endif
                                                    @endempty
                                                </p></div>
                                            <div class="text-end col-4">Adresse de livraison :</div>
                                            <div class="text-start col-8">
                                                <p>{{ $order->user_civilite .' '. $order->user_name }}<br>
                                                {{ $order->user_delivery_address }}<br>
                                                @if($order->user_delivery_address2)
                                                    {{ $order->user_delivery_address2 }}<br>
                                                @endif
                                                @foreach($cities as $city)
                                                    @if($city->postal_code == $order->user_delivery_cities)
                                                        {{ $city->postal_code }} - {{ $city->city }}
                                                        @endif
                                                    @endforeach
                                                {{ $order->user_delivery_phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 text-end">
                                <div class="card">
                                    <div class="card-body bg-gray">
                                        <h2>Total de la commande : {{ formatPriceToFloat($order->total_ttc) }} €</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    @endforeach

@endsection

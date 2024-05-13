<h3 class="mb-4">Récapitulatif de commande</h3>
@foreach($cart->product as $product)
    <div class="card rounded-3 mb-4">
        <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-md-2 col-lg-2 col-xl-2">
                    {{ $product->getFristImages($product) }}
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4">
                    <p class="lead fw-normal mb-2">{{ getProductInfos($product->product_id)->name  }}</p>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-2">
                    <p>Quantité</p><br>
                    <h5 class="mb-0">{{ $product->quantity }}</h5>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <p>Prix TTC</p><br>
                    <h5 class="mb-0">{{ $product->price_ttc }} €</h5>
                </div>
            </div>
        </div>
    </div>
@endforeach

@if(@$user_address)
    <h5>Mon adresse de livraison : ({{ $user_address->alias }})</h5>
    <p>{{ $user_address->first_name }} {{ $user_address->last_name }} -
    {{ $user_address->address }}
    {{ $user_address->address2 }}
    {{ $user_address->city }} - {{ $user_address->postal_code }}
    {{ $user_address->country }}
    {{ $user_address->phone }}
    {{ $user_address->other_phone }}</p>
@else
    <h5>Mon adresse de livraison :</h5>
@endif

<h5>Frais de livraison : </h5>

<h5 id="sous-total" class="text-end p-3">Sous-total ({{ $cart->countProduct() }} article) : {{ $cart->countProductsPrice() }} €</h5>
<p class="text-end" style="margin-top: -20px;">Le total de la commande inclut la TVA.</p>

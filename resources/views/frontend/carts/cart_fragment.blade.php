<div id="divpanier">
    @if(count($cart->product) > 0)
        <div class="row">
            <div class="col-md-9 col-12">
                <div class="row d-flex justify-content-between align-items-center text-center">
                    <div class="col-md-2">

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
                    <div class="col-md-1">

                    </div>
                </div>
                <hr>
                @foreach($cart->product as $product)
                    <div class="row d-flex justify-content-between align-items-center mt-3 mb-3 text-center">
                        <div class="col-md-2">
                            <img src="{{ getImageUrl(removeStorageFromURL($product->fav_image), 200, 200, 'fill-max') }}" class="img-fluid" alt="{{ $product->name }}">
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
                            <form> @csrf
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                        hx-post="{{ route('cart.down_quantity_product', $product->id) }}"
                                        hx-swap="outerHTML"
                                        hx-target="#divpanier">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </form>
                            <input id="quantity{{$product->id}}" name="quantity{{$product->id}}" value="{{ $product->quantity }}" type="number" min="1"
                                   class="form-control form-control-sm" readonly/>
                            <form> @csrf
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                                        hx-post="{{ route('cart.up_quantity_product', $product->id) }}"
                                        hx-swap="outerHTML"
                                        hx-target="#divpanier">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-2">
                            @if($product->discount_id)
                                <h6 class="text-decoration-line-through text-danger">{{ formatPriceToFloat($product->price_ttc) }} €</h6>
                                <h5 class="m-3">{{ formatPriceToFloat($product->price_ttc - ($product->price_ttc * $discountProducts[getProductInfos($product->product_id)->id]) / 100) }} €</h5>
                            @else
                                <h5 class="mb-0">{{ formatPriceToFloat($cart->priceProductQuantity($product->id)) }} €</h5>
                            @endif
                        </div>
                        <div class="col-md-1">
                            <a href="{{ route('cart.delete_product', $product->id) }}" onclick="return confirm('êtes-vous sûr de vouloir supprimer ce produit?');" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="col-md-3 col-12">

                @include('frontend.carts.partials.cart_summary')


                <div class="text-center">
                    <form action="{{ route('cart.chose_address') }}" method="post"> @csrf
                        <input id="ddd" name="ddd" type="hidden">
                        <button type="submit" class="btn btn-success btn-lg hvr-grow-shadow" id="commander"><i class="fa-solid fa-cart-shopping-fast"></i> Commander</button>
                    </form>
                </div>

            </div>
        </div>

    @else
        <h1 class="text-center m-5">Votre panier ne contient aucun produit</h1>
        <div class="text-center mb-5">
            <a class="btn btn-lg btn-primary hvr-grow-shadow" href="{{ route('index') }}"><i class="fa-solid fa-circle-left"></i> Retour a la page d'accueil</a>
        </div>
    @endif
</div>

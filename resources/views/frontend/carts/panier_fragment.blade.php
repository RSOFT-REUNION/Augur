<div id="divpanier">
    <h3 class="mb-4">Mon Panier</h3>
    @foreach($cart->product as $product)
        <div class="card rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-2">
                        {{ $product->getFristImages($product) }}
                    </div>
                    <div class="col-md-3">
                        <p class="lead fw-normal mb-2">{{ getProductInfos($product->product_id)->name  }}</p>
                        <p><span class="text-muted">Stock: </span> {{ getProductInfos($product->product_id)->stock  }}</p>
                    </div>
                    <div class="col-md-2 d-flex">
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
                    <div class="col-md-2 text-center">
                        <p>Prix Unitaire TTC</p>
                        <h5 class="mb-0">{{ formatPriceToFloat($product->price_ttc) }} €</h5>
                    </div>
                    <div class="col-md-2 text-center">
                        <p>Total TTC</p>
                        <h5 class="mb-0">{{ formatPriceToFloat($cart->priceProductQuantity($product->id)) }} €</h5>
                    </div>
                    <div class="col-md-1 text-end">
                        <a href="{{ route('cart.delete_product', $product->id) }}" onclick="return confirm('êtes-vous sûr de vouloir supprimer ce produit?');" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <h5 id="sous-total" class="text-end p-3">Sous-total ({{ $cart->countProduct() }} articles) : {{ formatPriceToFloat($cart->countProductsPrice()) }} €</h5>
    <p class="text-end" style="margin-top: -20px;">Le total de la commande inclut la TVA.</p>

    <div class="text-center mb-5">
        <!--<a href="{{ route('cart.chose_address') }}" class="btn btn-success btn-lg"> Commander </a>-->
        <form> @csrf @method('POST')
            <button type="button" class="btn btn-success btn-lg" id="commander"
                    hx-post="{{ route('cart.chose_address') }}"
                    hx-target="#divpanier"
                    hx-swap="outerHTML"
            > Commander</button>
        </form>
    </div>
</div>

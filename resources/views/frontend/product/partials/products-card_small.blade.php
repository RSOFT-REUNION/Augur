<div class="card content">
    @if(array_key_exists($product->id,$discountProducts))
        <h4 class="position-relative"><span class="badge text-bg-danger position-absolute top-0 start-50 translate-middle">Promo -{{ $discountProducts[$product->id] }} %</span></h4>
    @endif

    <a href="{{ route('product.show', $product->slug) }}">
        <img src="{{ $product->getFirstImagesURL(300, 300, 'fill-max') }}" class="d-block w-100 rounded-5" alt="{{ $product->name }}">
    </a>
    <div class="card-body">
        <h6 class="card-title text-center"><b>{{ $product->name }}</b></h6>
    </div>
    <div  class="card-footer text-center">

        @if(array_key_exists($product->id,$discountProducts))
            <h4 class="text-decoration-line-through text-danger">{{ formatPriceToFloat($product->price_ttc) }} €</h4>
            <h2 class="m-3">{{ formatPriceToFloat($product->price_ttc - ($product->price_ttc * $discountProducts[$product->id]) / 100) }} €</h2>
        @else
            <h2 class="m-3">{{ formatPriceToFloat($product->price_ttc) }} €</h2>
        @endif

        @if($product->stock > 0)
            <form>  @csrf
                @if (Cookie::has('session_id'))
                    <button type="button" class="btn btn-primary btn-sm mb-3 hvr-grow hvr-icon-buzz-out" id="add_cart"
                            hx-post="{{ route('cart.add_product', $product) }}"
                            hx-target="#nb_produit"
                            hx-swap="outerHTML"><i class="fa-solid fa-cart-plus hvr-icon"></i> Ajouter au panier
                    </button>
                @else
                    <button type="button" class="btn btn-primary btn-sm mb-3 hvr-grow hvr-icon-buzz-out" data-bs-toggle="modal" data-bs-target="#select_slot{{ $product->id }}">
                        <i class="fa-solid fa-cart-plus hvr-icon"></i> Ajouter au panier
                    </button>
                @endif
            </form>
        @else
            <button type="button" class="btn btn-danger btn-sm mb-3" disabled>En rupture de stock</button>
        @endif
    </div>
</div>

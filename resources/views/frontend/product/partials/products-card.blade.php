<div class="card content mt-3">
    @if(array_key_exists($product->id, $discountProducts))
        <h4 class="position-relative">
            @if($discountProducts[$product->id]['fixed_priceTTC'])
                <span class="badge text-bg-danger position-absolute top-0 start-50 translate-middle">
                    Promo
                </span>
            @else
                <span class="badge text-bg-danger position-absolute top-0 start-50 translate-middle">
                    Promo -{{ $discountProducts[$product->id]['discountPercentage'] }} %
                </span>
            @endif
        </h4>
    @endif

    <a href="{{ route('product.show', $product->slug) }}">
        <img src="{{ $product->getFirstImagesURL(300, 300, 'fill-max') }}" class="d-block w-100 rounded-5" alt="{{ $product->name }}">
    </a>
    <div class="card-body">
        <h6 class="card-title text-center"><b>{{ $product->name }}</b></h6>
        <p class="card-text">{{ $product->short_description }}</p>
    </div>
    <div class="card-header text-center">
        @foreach($product->labels as $label)
            <img class="p-2" src="{{ getImageUrl('/upload/specific/labels/'.$label->image, 70, 70, 'fill-max') }}" alt="{{ $label->name }}">
        @endforeach
    </div>
    <div  class="card-footer text-center">

        @if(array_key_exists($product->id,$discountProducts))
                @if($product->stock_unit == 'kg')
                    <div class="d-flex justify-content-center align-items-center">
                        <h4 class="text-decoration-line-through text-danger me-2">{{ formatPriceToFloat($product->price_ttc / 10) }} €</h4>
                        @if($discountProducts[$product->id]['fixed_priceTTC'])
                            <h2>{{ formatPriceToFloat($discountProducts[$product->id]['fixed_priceTTC'] / 10) }} €</h2>
                        @else
                            <h2>{{ formatPriceToFloat(($product->price_ttc - ($product->price_ttc * $discountProducts[$product->id]['discountPercentage']) / 100) / 10)  }} €</h2>
                        @endif
                    </div>
                    <p>les 100 grammes</p>
                @else
                    <div class="d-flex justify-content-center align-items-center">
                    <h4 class="text-decoration-line-through text-danger">{{ formatPriceToFloat($product->price_ttc) }} €</h4>
                    @if($discountProducts[$product->id]['fixed_priceTTC'])
                        <h2 class="m-3">{{ formatPriceToFloat($discountProducts[$product->id]['fixed_priceTTC']) }} €</h2>
                    @else
                        <h2 class="m-3">{{ formatPriceToFloat($product->price_ttc - ($product->price_ttc * $discountProducts[$product->id]['discountPercentage']) / 100) }} €</h2>
                    @endif
                    </div>
                @endif
        @else
            @if($product->stock_unit == 'kg')
                <h2 class="m-3">{{ formatPriceToFloat($product->price_ttc / 10) }} €</h2>
                <p style="margin-top: -18px;">les 100 grammes</p>
            @else
                <h2 class="m-3">{{ formatPriceToFloat($product->price_ttc) }} €</h2>
            @endif
        @endif

        @if($product->stock > 0)
            <form>  @csrf
                @if (Cookie::has('session_id'))
                    <div class="input-group mb-3 w-75 mx-auto">
                        <span class="input-group-text minus" >-</span>
                        <input type="number" name="quantity" id="quantity" class="form-control w-25" min="1" max="{{ $product->stock / 1000 }}" value="1">
                        <span class="input-group-text plus">+</span>
                        <span type="button" class="btn btn-primary btn-lg hvr-grow hvr-icon-buzz-out" id="add_cart"
                                hx-post="{{ route('cart.add_product', $product) }}"
                                hx-target="#nb_produit"
                                hx-swap="outerHTML"><i class="fa-solid fa-cart-plus hvr-icon"></i>
                        </span>
                    </div>
                @else
                    <button type="button" class="btn btn-primary btn-lg mb-3 hvr-grow hvr-icon-buzz-out" data-bs-toggle="modal" data-bs-target="#select_slot{{ $product->id }}">
                        <i class="fa-solid fa-cart-plus hvr-icon"></i> Ajouter au panier
                    </button>
                @endif
            </form>
        @else
            <button type="button" class="btn btn-danger mb-3 btn-lg" disabled>En rupture de stock</button>
        @endif
    </div>
</div>

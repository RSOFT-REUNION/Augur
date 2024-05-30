<div class="card content">
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
        <h2 class="m-3">{{ formatPriceToFloat($product->price_ttc) }} €</h2>
        @if($product->stock > 0)
            <form>  @csrf
                <button type="button" class="btn btn-primary btn-lg mb-3 hvr-grow" id="add_cart"
                        hx-post="{{ route('cart.add_product', $product) }}"
                        hx-target="#nb_produit"
                        hx-swap="outerHTML"><i class="fa-solid fa-cart-plus"></i> Ajouter au panier
                </button>
            </form>
        @else
            <button type="button" class="btn btn-danger mb-3 btn-lg" disabled>En rupture de stock</button>
        @endif
    </div>
</div>

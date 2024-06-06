<div class="modal fade" id="select_slot{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel">Liv'Express ou Click & Collect</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('frontend.carts.partials.select_slot_modal_content')
            </div>
            <div class="modal-footer">
                <form>  @csrf
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            hx-post="{{ route('cart.add_product', $product) }}"
                            hx-target="#nb_produit"
                            hx-swap="outerHTML">Choisir plus tard</button>
                </form>
            </div>
        </div>
    </div>
</div>

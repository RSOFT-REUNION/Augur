<div class="row row-flex" id="divdelivery">
    <div class="col-12 col-md-8">
        <h3 class="mb-5">Choix du mode de livraison</h3>

        <div class="row row-flex mb-5">
                @foreach($delivery as $deliver)
                        <div class="col-12 col-md-6">
                            <form action="{{ route('cart.chose_payment') }}" method="post"> @csrf
                                <input type="hidden" name="address" value="{{ @$user_address->id }}">
                                <input type="hidden" name="cart" value="{{ @$cart->id }}">
                                <input type="hidden" name="delivery" value="{{ $deliver->id }}">
                                <button type="submit" class="card text-center content hvr-grow-shadow">
                                    <div class="card-body">
                                        <p class="text-center">
                                            <img class="img-fluid" src="/storage/upload/order/delivery/{{ $deliver->image }}" alt="{{ $deliver->name }}">
                                        </p>
                                        <h3>{{ $deliver->name }}</h3>
                                        <p>Frais de livraison : @if($deliver->price_ttc == 0) <strong>Gratuit</strong> @else {{ formatPriceToFloat($deliver->price_ttc) }} €@endif</p>
                                    </div>
                                </button>
                            </form>
                        </div>
                @endforeach
        </div>
    </div>
    <div class="col-12 col-md-4">
        @include('frontend.carts.partials.cart_summary')
    </div>

</div>

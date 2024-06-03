<h2>Mon programme fidélité <i class="fa-solid fa-star"></i></h2>

@if($loyality->erp_loyalty_card)

    <div class="d-flex">
        <div class="p-2 flex-fill"><b>Carte n° :</b> {{ $loyality->erp_loyalty_card }}</div>
        <div class="p-2 flex-fill">
            <h4 class="text-end"> @if($loyality->erp_loyalty_points)
                    <b>{{ $loyality->erp_loyalty_points }}</b>
                @else
                    <b>0</b>
                @endif Points disponible</h4>
        </div>
    </div>

    @if($loyality->erp_loyalty_points >= 300)
        <div class="row row-flex justify-content-center">
            <div class="hvr-float-shadow col-md-2 col-12 p-1 m-2" style="cursor: pointer;">
                <form action="{{ route('cart.summary') }}" method="post" class="text-center"> @csrf
                    <input type="hidden" name="address" value="{{ @$user_address->id }}">
                    <input type="hidden" name="cart" value="{{ @$cart->id }}">
                    <input type="hidden" name="delivery" value="{{ @$delivery_chose->id }}">
                    <input type="hidden" name="loyality" value="0">

                    <div class="text-center">
                        <button type="submit" class="content btn btn-primary">
                            <img class="img-fluid mb-3" src="{{ asset('frontend/images/discount.png') }}">
                            <h1 class="mx-auto text-white" style=" font-size: 42px;"> 0 <i
                                    class="fa-solid fa-percent"></i></h1>
                            <p>Aucun point de fidélité ne sera utilisé.</p>
                        </button>
                    </div>

                </form>
            </div>
            <div class="hvr-float-shadow col-md-2 col-12 p-1 m-2" style="cursor: pointer;">
                <form action="{{ route('cart.summary') }}" method="post" class="text-center"> @csrf
                    <input type="hidden" name="address" value="{{ @$user_address->id }}">
                    <input type="hidden" name="cart" value="{{ @$cart->id }}">
                    <input type="hidden" name="delivery" value="{{ @$delivery_chose->id }}">
                    <input type="hidden" name="loyality" value="5">

                    <div class=" text-center content">
                        <button type="submit" class="content btn btn-warning">
                            <img class="img-fluid mb-3" src="{{ asset('frontend/images/discount.png') }}">
                            <h1 class="mx-auto" style=" font-size: 42px;"> - 5 <i class="fa-solid fa-percent"></i></h1>
                            <p><b>300</b> point de fidélité seront utilisé.</p>
                        </button>
                    </div>
                </form>
            </div>
            @if($loyality->erp_loyalty_points >= 500)
                <div class="hvr-float-shadow col-md-2 col-12 p-1 m-2" style="cursor: pointer;">
                    <form action="{{ route('cart.summary') }}" method="post" class="text-center"> @csrf
                        <input type="hidden" name="address" value="{{ @$user_address->id }}">
                        <input type="hidden" name="cart" value="{{ @$cart->id }}">
                        <input type="hidden" name="delivery" value="{{ @$delivery_chose->id }}">
                        <input type="hidden" name="loyality" value="10">

                        <div class="card bg-gray text-center content">
                            <button type="submit" class="content btn btn-primary">
                                <img class="img-fluid mb-3" src="{{ asset('frontend/images/discount.png') }}">
                                <h1 class="mx-auto text-white" style=" font-size: 42px;"> - 10 <i
                                        class="fa-solid fa-percent"></i></h1>
                                <p><b>500</b> point de fidélité seront utilisé.</p>
                            </button>
                        </div>
                    </form>
                </div>
                @if($loyality->erp_loyalty_points >= 1000)
                    <div class="hvr-float-shadow col-md-2 col-12 p-1 m-2" style="cursor: pointer;">
                        <form action="{{ route('cart.summary') }}" method="post" class="text-center"> @csrf
                            <input type="hidden" name="address" value="{{ @$user_address->id }}">
                            <input type="hidden" name="cart" value="{{ @$cart->id }}">
                            <input type="hidden" name="delivery" value="{{ @$delivery_chose->id }}">
                            <input type="hidden" name="loyality" value="15">

                            <div class="card bg-gray text-center content">
                                <button type="submit" class="content btn btn-warning">
                                    <img class="img-fluid mb-3" src="{{ asset('frontend/images/discount.png') }}">
                                    <h1 class="mx-auto" style=" font-size: 42px;"> - 15 <i
                                            class="fa-solid fa-percent"></i></h1>
                                    <p><b>1 000</b> point de fidélité seront utilisé.</p>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        </div>
    @else
        <h3 class="text-center m-4">Vous n'avez pas encore obtenu suffisamment de points</h3>
        <div class="text-center">
            <a href="" class="btn btn-lg btn-primary hvr-grow-shadow"><i class="fa-solid fa-list-check"></i>
                Récapitulatif de ma commande</a>
        </div>
    @endif

@else
    <h2>Vous n'avais pas encore de carte</h2>
    <i class="fa-solid fa-credit-card fa-4x m-3"></i>
    <div class="text-center">
        <a href="" class="btn btn-lg btn-primary hvr-grow-shadow"><i class="fa-solid fa-list-check"></i> Récapitulatif
            de ma commande</a>
    </div>
@endif

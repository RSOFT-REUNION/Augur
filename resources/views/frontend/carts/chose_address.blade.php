<h3 class="mb-5 text-center">Passer la commande</h3>

@auth
        <div class="row row-flex" id="divaddress">
            <div class="col-12 col-md-8">
                <h3 class="mb-5">Sélectionnez une adresse de livraison</h3>

                <div class="row row-flex" id="address_list">
                    @forelse($address as $addres)
                        <div class="col-12 col-md-6 mb-5">
                            <div class="card text-center content">
                                <div class="card-body" @if($addres->id == $addres->type_fav) style="background-color: #eeeeee;" @endif>
                                    <h4 class="card-title">{{ $addres->alias }}</h4>
                                    <p class="card-text">{{ $addres->first_name }} {{ $addres->last_name }}</p>
                                    <p class="card-text">{{ $addres->address }}</p>
                                    <p class="card-text">{{ $addres->address2 }}</p>
                                    <p class="card-text">{{ $addres->other }}</p>
                                    <p class="card-text">{{ $addres->city }} - {{ $addres->postal_code }}</p>
                                    <p class="card-text">{{ $addres->country }}</p>
                                    <p class="card-text">{{ $addres->phone }}</p>
                                    <p class="card-text">{{ $addres->other_phone }}</p>
                                    <form method="post">
                                        @csrf
                                        <input type="hidden" name="address" value="{{ $addres->id }}">
                                        <input type="hidden" name="cart" value="{{ $cart->id }}">
                                        <button type="submit" class="btn btn-primary"
                                                hx-post="{{ route('cart.chose_delivery') }}"
                                                hx-swap="outerHTML"
                                                hx-target="#divaddress">
                                            @if($addres->id == $addres->favorite)
                                                <i class="fa-solid fa-star"></i>
                                                @endif Selectionner</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h4>Vous n'avais pas encore d'adresse</h4>
                        <div class="text-end"><a href="{{ route('adresse.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> Ajouter </a></div>
                    @endif

                </div>
            </div>
            <div class="col-12 col-md-4">
                @include('frontend.carts.partials.cart_summary')
            </div>

        </div>
    @endauth
    @guest
        @include('frontend.auth.login')
    @endguest

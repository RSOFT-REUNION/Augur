@extends('backend.layouts.layout')
@section('title', 'Modifier une promotion')

@section('main-content')
    <div>



        <form id="myForm" action="{{ route('backend.catalog.discounts.update', $discount) }}"
              method="post" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="d-flex gap-2 justify-content-start mb-3 me-5">
                <div class=" d-flex align-items-center">

                    <button type='button' class="btn btn-outline-secondary hvr-shadow ml-3"
                            onclick="location.href='{{ route('backend.catalog.discounts.index') }}'">
                        <i class="fa-solid fa-arrow-left"></i> Retourner à la liste
                    </button>
                 {{--   <button type="button" class="btn btn-danger hvr-float-shadow ml-2"
                            title="Annuler"
                            data-bs-toggle="modal"
                            data-bs-target="#cancelModal">
                        <i class="fa-solid fa-rotate-left"></i> Annuler
                    </button>--}}

                </div>
            </div>

            <!-- Modal de confirmation d'annulation des modifications -->
            {{--<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div></div>
                            <h5 class="modal-title" id="exampleModalLabel">Êtes-vous sûr ?</h5>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <div class="modal-body text-center text-danger text-wrap">
                            Toutes vos modifications non-enregistrés sur {{ $discount->name }}
                            seront perdues.
                        </div>
                        <div class="modal-footer">
                            <button type='button' class="btn btn-danger hvr-float-shadow"
                                    onclick="location.href='{{ route('backend.catalog.discounts.edit', $discount) }}'">
                                <i class="fa-solid fa-xmark"></i> Supprimer les modifications en cours
                            </button>
                            <button type="button" class="btn btn-primary hvr-float-shadow" data-bs-dismiss="modal">
                                Continuer à modifier <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
--}}
            <div class="row">
                <!-- INFOS GENERALES -->
                <div class="col-5">
                    <div class="card border-left-primary shadow mb-4">
                        <div class="card-header d-flex justify-content-between py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Informations générales</h6>
                            <div class="form-check form-switch d-flex align-items-center">
                                <input class="form-check-input"
                                       @if($discount->active) checked @endif
                                       type="checkbox" role="switch" id="active" name="active">
                                <label class="form-check-label" for="active">Activer</label>
                                <button type="submit" form="myForm" class="btn btn-success hvr-float-shadow ml-2"><i
                                        class="fa-solid fa-check"></i> Enregistrer
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                {{-- NOM --}}
                                <div class="form-group col-8">
                                    <label class="form-control-label" for="name">Nom de la promotion <span class="small text-danger">(obligatoire)</span></label>
                                    <input type="text" id="name" name="name"
                                           class="@error('name') is-invalid @enderror form-control required"
                                           value="{{ old('name', $discount->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- POURCENTAGE DE REMISE --}}
                                <div class="form-group col-4">
                                    <label for="percentage" class="form-label">Pourcentage de remise</label>
                                    <div class="input-group">
                                        <input type="number" class="@error('percentage') is-invalid @enderror form-control" min="1" max="100" id="percentage" name="percentage" value="{{ old('percentage', $discount->percentage) }}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @error('percentage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{--DATES --}}
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="form-control-label" for="start_date">Début : </label>
                                    <input type="date" id="start_date" name="start_date"
                                           class="@error('start_date') is-invalid @enderror form-control"
                                           value="{{ old('start_date', $discount->start_date ) }}">
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label class="form-control-label" for="end_date">Fin : </label>
                                    <input type="date" id="end_date" name="end_date"
                                           class="@error('end_date') is-invalid @enderror form-control"
                                           value="{{ old('end_date', $discount->end_date ) }}">
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- ICONE --}}
                            <div class="col">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="form-control-label" for="icon">Icône</label>
                                    </div>
                                    <div>
                                        <input type="radio" class="btn-check" name="icon" id="star" @if($discount->icon == 'star') checked @endif value="star">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="star"><i class="fa-regular fa-star"></i></label>

                                        <input type="radio" class="btn-check" name="icon" id="heart" @if($discount->icon == "heart") checked @endif value="heart">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="heart"><i class="fa-regular fa-heart"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="bolt" @if($discount->icon == "bolt") checked @endif value="bolt">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="bolt"><i class="fa-regular fa-bolt"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="gift" @if($discount->icon == "gift") checked @endif value="gift">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="gift"><i class="fa-regular fa-gift"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="snowflake" @if($discount->icon == "snowflake") checked @endif value="snowflake">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="snowflake"><i class="fa-regular fa-snowflake"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="grill-hot" @if($discount->icon == "grill-hot") checked @endif value="grill-hot">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="grill-hot"><i class="fa-regular fa-grill-hot"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="fish" @if($discount->icon == "fish") checked @endif value="fish">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="fish"><i class="fa-regular fa-fish"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="leaf" @if($discount->icon == "leaf") checked @endif value="leaf">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="leaf"><i class="fa-regular fa-leaf"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="award" @if($discount->icon == "award") checked @endif value="award">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="award"><i class="fa-regular fa-award"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="head-side" @if($discount->icon == "head-side") checked @endif value="head-side">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="head-side"><i class="fa-regular fa-head-side"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="meat" @if($discount->icon == "meat") checked @endif value="meat">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="meat"><i class="fa-regular fa-meat"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="sparkles" @if($discount->icon == "sparkles") checked @endif value="sparkles">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="sparkles"><i class="fa-regular fa-sparkles"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="bookmark" @if($discount->icon == "bookmark") checked @endif value="bookmark">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="bookmark"><i class="fa-regular fa-bookmark"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="circle-euro" @if($discount->icon == "circle-euro") checked @endif value="circle-euro">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="circle-euro"><i class="fa-regular fa-circle-euro"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="mug-tea" @if($discount->icon == "mug-tea") checked @endif value="mug-tea">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="mug-tea"><i class="fa-regular fa-mug-tea"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="watermelon-slice" @if($discount->icon == "watermelon-slice") checked @endif value="watermelon-slice">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="watermelon-slice"><i class="fa-regular fa-watermelon-slice"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="tree-palm" @if($discount->icon == "tree-palm") checked @endif value="tree-palm">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="tree-palm"><i class="fa-regular fa-tree-palm"></i></label>

                                        <input type="radio" class="btn-check hvr-shrink" name="icon" id="user-tie" @if($discount->icon == "user-tie") checked @endif value="user-tie">
                                        <label class="btn btn-lg btn-outline-dark hvr-grow" for="user-tie"><i class="fa-regular fa-user-tie"></i></label>
                                    </div>
                                    <div id="icon" class="form-text">
                                        <i class="fa-light fa-circle-info"></i>
                                        L'icône sert à l'affichage côté client dans les menus de navigations, sur les filtres promos etc.
                                    </div>
                                    @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- DESCRIPTION COURTE --}}
                            <div class="form-group">
                                <label class="form-control-label" for="short_description">Description courte <span class="small text-body-secondary">(facultatif)</span></label>
                                <textarea id="short_description" name="short_description" maxlength="255" rows="3"
                                          class="@error('short_description') is-invalid @enderror form-control">{{ old('short_description', $discount->short_description ) }}</textarea>
                                <div id="price_ttc" class="form-text">Maximum 255 caractères.</div>
                                @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                </div>
                <!-- PRODUITS -->
                <div class="col-7">

                    <div class="card border-left-warning shadow mb-4">
                        <div class="card-header py-3">

                            <div class="d-flex justify-content-between">
                                <h6 class="m-0 font-weight-bold text-warning">Produits concernés</h6>
                                <button type="button" class="btn btn-warning"
                                        title="Ajouter"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-add">
                                    <i class="fa-solid fa-plus"></i> Ajouter des produits
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            @include('backend.catalog.discount.partial.discounted_products')
                        </div>
                    </div>
                </div>
            </div>
        </form>



        {{-- MODAL LISTE DES PRODUITS AJOUTABLES A LA REMISE --}}
        <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modal-add" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body mb-3 m-2 ml-4 mr-4">

                        @if(count($products_list) > 0)
                            <form hx-encoding='multipart/form-data'
                                  hx-post='{{ route('backend.catalog.discounts.add_products', $discount) }}'
                                  hx-target="#discounted_list"
                                  hx-swap="outerHTML"
                            >
                                @csrf

                                <div>
                                    <ul class="list-group list-group-flush">
                                        @foreach($products_list as $product)
                                            @if($discount->products->where('product_id', $product->id)->isEmpty())
                                                <label class="list-group-item d-flex justify-content-between hvr-skew-forward">

                                                    <input class="form-check-input" type="checkbox" value="{{ $product }}" name="discount_products[]" id="product{{ $product->id }}">
                                                    @if($product->fav_image != null)
                                                        <img src="{{ $product->getFirstImagesURL(100, 100) }}" style="max-height: 20px;">
                                                    @else
                                                        <i class="fa-light fa-image-slash"></i>
                                                    @endif
                                                    <h6 >{{ $product->name }} </h6>
                                                    <h5 >{{ formatPriceToFloat($product->price_ttc) }} €</h5>
                                                </label>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="input-group mb-2 mt-4 justify-content-end">
                                    <button class="btn btn-success" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-plus"></i> Ajouter
                                    </button>
                                </div>
                            </form>
                        @else
                            <h3>Aucun produit</h3>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@extends('backend.layouts.layout')
@section('title', $discount->exists ? __('Modifier une promotion') : __('Créer une promotion'))

@section('main-content')

    <form id="createForm" class="justify-content-center" action="{{ route('backend.catalog.discounts.store') }}"
          method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="d-flex gap-2 justify-content-end mb-3 me-5">
            <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input"
                       @if(!$discount->exists) checked @endif
                       @if($discount->active) checked @endif
                       type="checkbox" role="switch" id="active" name="active">
                <label class="form-check-label" for="active">Activer</label>
            </div>
            <button type='button' class="btn btn-danger hvr-float-shadow"
                    onclick="location.href='{{ route('backend.catalog.discounts.index') }}'">
                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
            </button>
            <button type="submit" class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-pen-to-square"></i>
                @if ($discount->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

        <div class="row m-2">
            <div class="col">
                <div class="card border-left-primary shadow mb-4">

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informations</h6>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            {{-- NOM --}}
                            <div class="form-group col-8">
                                <label class="form-control-label" for="name">Nom de la promotion : <span
                                        class="small text-danger">*</span></label>
                                <input type="text" id="name" name="name"
                                       class="@error('name') is-invalid @enderror form-control required"
                                       value="{{ old('name', $discount->name ) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- POURCENTAGE DE REMISE --}}
                            <div class="form-group col-4">
                                <label for="percentage" class="form-label">Pourcentage de remise : <span
                                        class="small text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="@error('percentage') is-invalid @enderror form-control"
                                           min="1" max="100" id="percentage" name="percentage"
                                           value="{{ old('percentage', $discount->percentage) }}">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            {{--DATES --}}
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label" for="start_date">Début : <span
                                            class="small text-danger">*</span></label>
                                    <input type="date" id="start_date" name="start_date"
                                           class="@error('start_date') is-invalid @enderror form-control"
                                           value="{{ old('start_date', $discount->start_date) }}">
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="form-control-label" for="end_date">Fin : <span
                                            class="small text-danger">*</span></label>
                                    <input type="date" id="end_date" name="end_date"
                                           class="@error('end_date') is-invalid @enderror form-control"
                                           value="{{ old('end_date', $discount->end_date) }}">
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- DESCRIPTION COURTE --}}
                            <div class="form-group">
                                <label class="form-control-label" for="short_description">Description courte <span
                                        class="small text-body-secondary">(facultatif)</span></label>
                                <textarea id="short_description" name="short_description" maxlength="255" rows="3"
                                          class="@error('short_description') is-invalid @enderror form-control">{{ old('short_description', $discount->short_description) }}</textarea>
                                <div id="price_ttc" class="form-text">Maximum 255 caractères.</div>
                                @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @if($discount->exists)
        <div class="row m-2">
            <div class="col">
                <div class="card border-left-warning shadow mb-4">
                    <div class="card-header py-3">
                        <div class="d-flex">
                            <div class="flex-fill"><h6 class="m-0 font-weight-bold text-warning">Liste Produits</h6></div>
                            <div class="p-2 flex-fill text-end">
                                <button type="button" class="btn btn-warning btn-sm text-end"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-add">
                                    <i class="fa-solid fa-plus"></i> Ajouter des produits
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('backend.catalog.discount.partial.discounted_products')
                    </div>
                </div>
            </div>
        </div>
    @endif

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
                     <form    hx-post='{{ route('backend.catalog.discounts.add_products', $discount) }}'
                              hx-target="#discounted_list"
                              hx-swap="outerHTML">
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

                </div>
            </div>
        </div>
    </div>

@endsection

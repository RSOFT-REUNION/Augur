@extends('backend.layouts.layout')
@section('title', $product->exists ? __('Modifier un produit') : __('Créer un produit'))

@section('main-content')
    <form action="{{ route($product->exists ? 'backend.catalog.products.update' : 'backend.catalog.products.store', $product) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method($product->exists ? 'put' : 'post')

        <div class="d-flex gap-2 justify-content-end mb-3 me-5">
            <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input"
                       @if(!$product->exists) checked @endif
                       @if($product->active) checked @endif
                       type="checkbox" role="switch" id="active" name="active">
                <label class="form-check-label" for="active">Publique</label>
            </div>
            <button type='button' class="btn btn-danger hvr-float-shadow"
                    onclick="location.href='{{ route('backend.catalog.products.index') }}'">
                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
            </button>
            <button type="submit" class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-pen-to-square"></i>
                @if ($product->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

        <div class="row m-2">
            <div class="col-md-8 col-12">
                <div class="card border-left-secondary shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-secondary">Catégorie</h6>
                    </div>
                    <div class="card-body">
                        <select class="form-select tomselect @error('categorie') is-invalid @enderror" aria-label="category_id"
                                id="category_id" name="category_id">
                            <option value=""> Aucune catégorie </option>
                            @foreach($categories as $category)
                                <option @if($category->id == $product->category_id) selected @endif value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categorie')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card border-left-primary shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informations</h6>
                    </div>
                    <div class="card-body row d-flex gap-2 justify-content-end mb-3">
                            {{-- NAME --}}
                            <div class="form-group">
                                <label class="form-control-label" for="name">Libellé du produit <span class="small text-danger">*</span></label>
                                <input id="name" type="text" name="name"
                                       class="@error('name') is-invalid @enderror form-control" required
                                       value="{{ old('name', $product->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- SLUG --}}
                        <div class="form-group">
                            <label class="form-control-label" for="name">Slug</label>
                            <input class="form-control" id="slug" type="text" name="slug" value="{{ old('slug', $product->slug) }}" readonly disabled>
                        </div>
                            {{-- CODE ARTICLE (EBP ou SAP) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="code_article">Code Article</label>
                                <input id="name" type="text" name="code_article"
                                       class="@error('code_article') is-invalid @enderror form-control"
                                       value="{{ old('code_article', $product->code_article) }}">
                                @error('code_article')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- MARQUES --}}
                            {{--<div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-secondary"> Marques</h6>
                            </div>
                            <div class="card-body">
                                <select class="form-select tomselect @error('marque') is-invalid @enderror"
                                        aria-label="brand_id"
                                        id="brand_id"
                                        name="brand_id">
                                    <option value=""> Aucune marque </option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"> {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('marque')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>--}}



                            {{-- DESCRIPTION --}}
                            <div class="form-group">
                                <label class="form-control-label" for="description">Description </label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- COMPOSITION (ingrédients, allergènes etc) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="composition">Composition (ingrédients, allergènes etc.) </label>
                                <textarea name="composition" id="composition" class="@error('composition') is-invalid @enderror form-control">{{ old('composition', $product->composition) }}</textarea>
                                @error('composition')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TAGS --}}
                            <div class="form-group">
                                <label class="form-control-label" for="tags">Tags </label>
                                <textarea name="tags" id="tags" class="@error('tags') is-invalid @enderror form-control">{{ old('tags', $product->tags) }}</textarea>
                                @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CODE BARRE --}}
                            <div class="form-group">
                                <label class="form-control-label" for="barcode">Code Barre </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                    <input name="barcode" id="barcode" class="@error('barcode') is-invalid @enderror form-control" value="{{ old('barcode', $product->barcode) }}"">
                                </div>
                                @error('barcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row form-group">
                                {{-- STOCK --}}
                                <div class="col-4">
                                    <label class="form-control-label" for="stock">Quantité en stock <span class="small text-danger">*</span></label>
                                    <div class="input-group">
                                        {{-- QUANTITE EN STOCK --}}
                                        <input type="number" step="0.001" min="0" name="stock" id="stock" class="@error('stock') required is-invalid @enderror form-control" value="{{ old('weight', $product->stock / 1000) }}">
                                        {{-- UNITE DE STOCKAGE / à l'unité ou vrac (kilo) --}}
                                        <select class="@error('stock_unit') required is-invalid @enderror form-select" aria-label="stock_unit"
                                                id="stock_unit"
                                                name="stock_unit">
                                            <option selected value="unit">unités</option>
                                            <option value="kg">kg (vente en vrac)</option>
                                        </select>
                                    </div>
                                    @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- POIDS A l'UNITE --}}
                                <div class="col-6">
                                    <label class="form-control-label" for="weight">Poids à l'unité</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" min="0" name="weight" id="weight" class="@error('weight') required is-invalid @enderror form-control" value="{{ old('weight', $product->weight / 100) }}">
                                        <select class="@error('weight_unit') required is-invalid @enderror form-select" aria-label="weight_unit"
                                                id="weight_unit"
                                                name="weight_unit">
                                            <option selected value="kg">Kg (Kilogramme)</option>
                                            <option value="l">L (Litre)</option>
                                        </select>
                                    </div>
                                    @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>


                            {{-- PRIX HT / TTC / TVA --}}
                            <div class="row form-group">
                                <div class="col-3">
                                    <label class="form-control-label" for="price_ht">Prix HT <span class="small text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="0.01" min="0" name="price_ht" id="price_ht" class="@error('price_ht') required is-invalid @enderror form-control" value="{{ old('price_ht', $product->price_ht / 100) }}">
                                        <span class="input-group-text">€</span>
                                        @error('price_ht')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-control-label" for="price_ttc">Prix TTC <span class="small text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="0.01" min="0" name="price_ttc" id="price_ttc" class="@error('price_ttc') required is-invalid @enderror form-control" value="{{ old('price_ttc', $product->price_ttc / 100) }}">
                                        <span class="input-group-text">€</span>
                                        @error('price_ttc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label class="form-control-label" for="tva">TVA </label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="0.01" min="0" name="tva" id="tva" class="@error('tva') is-invalid @enderror form-control" value="{{ old('tva', $product->tva /100) }}">
                                        <span class="input-group-text">%</span>
                                        @error('tva')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12">
                <div class="card border-left-warning shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning">Images</h6>
                    </div>
                    <div class="card-body">

                        @if ($product->exists)
                            <div class="text-center">
                                <button type="button" class="btn btn-success btn-lg mb-3 hvr-float-shadow" data-toggle="modal" data-target="#addImagesModal">
                                    <i class="fa-solid fa-plus"></i> Ajouter
                                </button>
                            </div>
                            @include('backend.catalog.product.partial.images_list')
                        @else
                            <div class="form-group">
                                <input type="file" accept=".jpeg, .png, .jpg, .gif, .svg" name="images[]" id="images" multiple
                                       class="@error('images') is-invalid @enderror form-control"
                                       value="{{ old('images') }}"></input>
                                @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </form>
    <!-- Modal d'ajout d'image -->
    @if ($product->exists)
        <div class="modal fade" id="addImagesModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalTitle" aria-hidden="true">
            <form action="{{route('backend.catalog.products.add_image', $product)}}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Ajouter des images</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="file" accept=".jpeg, .png, .jpg, .gif, .svg" name="images[]" id="images" multiple
                                       class="@error('images') is-invalid @enderror form-control"
                                       value="{{ old('images') }}"></input>
                                @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <button class="btn btn-success">Ajouter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif

@endsection

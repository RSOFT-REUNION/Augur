{{--@php
    $product ??= '';
    $categories ??= '';
@endphp--}}

<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="modal-create" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Créer un produit</h5>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="justify-content-center" action="{{ route('backend.catalog.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row d-flex gap-2 justify-content-end mb-3">
                        <div class="col m-2">
                            {{-- NAME --}}
                            <div class="form-group">
                                <label class="form-control-label" for="name">Libellé du produit <span class="small text-danger">*</span></label>
                                <input id="name" type="text" name="name"
                                       class="@error('name') is-invalid @enderror form-control" required
                                       value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- SLUG --}}
{{--                            <span class="form-control" id="slug" type="text" name="slug" value="Readonly input here..." aria-label="readonly input example" readonly></span>--}}

                            {{-- CODE ARTICLE (EBP ou SAP) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="code_article">Code Article</label>
                                <input id="name" type="text" name="code_article"
                                       class="@error('code_article') is-invalid @enderror form-control"
                                       value="{{ old('code_article') }}">
                                @error('code_article')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- IMAGES --}}
                        <div class="col">
                            <div class="card border-left-warning shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-warning">Images</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="file" accept=".jpeg, .png, .jpg, .gif, .svg" name="images[]" id="images" multiple
                                               class="@error('images') is-invalid @enderror form-control"
                                               value="{{ old('images') }}">
                                        @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row m-2">
                            {{-- CATEGORIE --}}
                            <div class="form-group">
                                <label class="form-control-label" for="code_article">Catégorie</label>
                                <select class="form-select @error('categorie') is-invalid @enderror"
                                        aria-label="category_id"
                                        id="category_id"
                                        name="category_id">
                                    <option value=""> Aucune catégorie </option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categorie')
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
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- COMPOSITION (ingrédients, allergènes etc) --}}
                            <div class="form-group">
                                <label class="form-control-label" for="composition">Composition (ingrédients, allergènes etc.) </label>
                                <textarea name="composition" id="composition" class="@error('composition') is-invalid @enderror form-control">{{ old('composition') }}</textarea>
                                @error('composition')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TAGS --}}
                            <div class="form-group">
                                <label class="form-control-label" for="tags">Tags </label>
                                <textarea name="tags" id="tags" class="@error('tags') is-invalid @enderror form-control">{{ old('tags') }}</textarea>
                                @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- CODE BARRE --}}
                            <div class="form-group">
                                <label class="form-control-label" for="barcode">Code Barre </label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                                    <input name="barcode" id="barcode" class="@error('barcode') is-invalid @enderror form-control" value="{{ old('barcode') }}">
                                </div>
                                @error('barcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group row">

                                {{-- STOCK --}}
                                <div class="col">
                                    <label class="form-control-label" for="stock">Quantité en stock <span class="small text-danger">*</span></label>
                                    <div class="input-group">
                                        {{-- QUANTITE EN STOCK --}}
                                        <input type="number" step="0.001" min="0" name="stock" id="stock" class="@error('stock') is-invalid @enderror form-control" value="{{ old('stock') }}">
                                        {{-- UNITE DE STOCKAGE / à l'unité ou vrac (kilo) --}}
                                        <select class="@error('stock_unit') required is-invalid @enderror form-select" aria-label="stock_unit"
                                                id="stock_unit"
                                                name="stock_unit">
                                            <option selected value="unit">articles</option>
                                            <option value="kg">kg (vente en vrac)</option>
                                        </select>
                                    </div>
                                    @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- POIDS A l'UNITE --}}
                                <div class="col">
                                    <label class="form-control-label" for="weight">Poids d'un article (si vente à l'unité)</label>
                                    <div class="input-group">
                                        <input type="number" step="0.01" min="0" name="weight" id="weight" class="@error('weight') is-invalid @enderror form-control" value="{{ old('weight') }}">
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
                            <div class="form-group row ">
                                <div class="col">
                                    <label class="form-control-label" for="price_ht">Prix HT <span class="small text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="0.01" min="0" name="price_ht" id="price_ht" class="@error('price_ht') is-invalid @enderror form-control" value="{{ old('price_ht') }}">
                                        <span class="input-group-text">€</span>
                                        @error('price_ht')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-control-label" for="price_ttc">Prix TTC <span class="small text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="0.01" min="0" name="price_ttc" id="price_ttc" class="@error('price_ttc') is-invalid @enderror form-control" value="{{ old('price_ttc') }}">
                                        <span class="input-group-text">€</span>
                                        @error('price_ttc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-control-label" for="tva">TVA </label>
                                    <div class="input-group mb-3">
                                    <input type="number" step="0.01" min="0" name="tva" id="tva" class="@error('tva') is-invalid @enderror form-control" value="{{ old('tva') }}">
                                    <span class="input-group-text">%</span>
                                    @error('tva')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            {{--  ACTIVE  --}}
                            <div class="form-group row justify-content-end">
                                <div class="form-check form-switch col-4">
                                    <input class="form-check-input" checked
                                           type="checkbox" role="switch" id="active" name="active" value="on">
                                    <label class="form-check-label" for="active">Rendre publique</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </div>
                    </div>



                </form>
            </div>
        </div>

    </div>
</div>

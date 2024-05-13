@extends('backend.layouts.layout')
@section('title', $products->exists ? __('Modifier un produit') : __('Créer un produit'))

@section('main-content')
    <form action="{{ route($products->exists ? 'backend.catalog.products.update' : 'backend.catalog.products.store', $products) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method($products->exists ? 'put' : 'post')

        <div class="d-flex gap-2 justify-content-end mb-3 me-5">
            <div class="form-check form-switch d-flex align-items-center">
                <input class="form-check-input"
                       @if(!$products->exists) checked @endif
                       @if($products->active) checked @endif
                       type="checkbox" role="switch" id="active" name="active">
                <label class="form-check-label" for="active">Activer</label>
            </div>
            <button type='button' class="btn btn-danger hvr-float-shadow"
                    onclick="location.href='{{ route('backend.catalog.products.index') }}'">
                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
            </button>
            <button type="submit" class="btn btn-success hvr-float-shadow"><i class="fa-solid fa-pen-to-square"></i>
                @if ($products->exists)
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
                            @foreach($categories_list as $category_list)
                                <option @if($category_list->id == $products->category_id) selected @endif value="{{ $category_list->id }}"> {{ $category_list->name }}</option>
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
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nom du produit <span class="small text-danger">*</span></label>
                            <input id="name" type="text" name="name"
                                   class="@error('name') is-invalid @enderror form-control" required
                                   value="{{ old('name', $products->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <input class="d-none" id="slug" type="text" name="slug" disabled value="{{ $products->slug }}">

                        <div class="form-group">
                            <label class="form-control-label" for="description">Description </label>
                            <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control">{{ old('description', $products->description) }}</textarea>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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

                        @if ($products->exists)
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

        <div class="form-group">
            <label class="form-control-label" for="size">Taille</label>
            <input id="size" type="text" name="size"
                   class="@error('size') is-invalid @enderror form-control"
                   value="{{ $products->size }}">
            @error('size')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-control-label" for="price">Prix</label>
            <input id="price" type="text" name="price"
                   class="@error('price') is-invalid @enderror form-control"
                   value="{{ old('price', $products->price) }}">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </form>
    <!-- Modal d'ajout d'image -->
    @if ($products->exists)
        <div class="modal fade" id="addImagesModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalTitle" aria-hidden="true">
            <form action="{{route('backend.catalog.products.add_image', $products)}}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
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

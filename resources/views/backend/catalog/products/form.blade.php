@extends('backend.layouts.layout')
@section('title', $products->exists ? __('Modifier un produit') : __('Créer un produit'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($products->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'un produit</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route($products->exists ? 'backend.catalog.products.update' : 'backend.catalog.products.store', $products) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method($products->exists ? 'put' : 'post')

                        @if ($products->exists)
                            <div class="text-center mb-3">
                                <img style="max-height: 150px;" src="/storage/upload/catalog/products/{{ $products->image }}"
                                    alt="{{ $products->title }}">
                            </div>
                        @endif

                        <div class="m-0w">
                            <label for="category_id" class="form-label">Catégorie</label>
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

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="title">Nom du produit <span class="small text-danger">*</span></label>
                                    <input id="title" type="text" name="title"
                                           class="@error('title') is-invalid @enderror form-control" required
                                           value="{{ old('title', $products->title) }}">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="slug">Slug</label>
                                    <input id="slug" type="text" name="slug" disabled
                                           class="@error('slug') is-invalid @enderror form-control"
                                           value="{{ $products->slug }}">
                                    @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="price">Prix</label>
                                    <input id="price" type="text" name="price"
                                           class="@error('price') is-invalid @enderror form-control"
                                           value="{{ old('price', $products->price) }}">
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="size">Taille</label>
                                    <input id="size" type="text" name="size"
                                           class="@error('size') is-invalid @enderror form-control"
                                           value="{{ $products->size }}">
                                    @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="image">
                                        @if ($products->exists)
                                            Changer l'image :
                                        @else
                                            Image :
                                        @endif
                                    </label>
                                    <input type="file" name="image" id="image"
                                        class="@error('image') is-invalid @enderror form-control"
                                        value="{{ old('image') }}"></input>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="m-0w">
                            <div class="form-group">
                                <label class="form-control-label" for="description">Description <span class="small text-danger">*</span></label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control" required>{{ old('description', $products->description) }}</textarea>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.catalog.products.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($products->exists)
                                    Modifier
                                @else
                                    Créer
                                @endif
                            </button>&nbsp;&nbsp;
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

@extends('backend.layouts.layout')
@section('title', $category->exists ? __('Modifier une catégorie') : __('Créer une catégorie'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($category->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'une categorie</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route($category->exists ? 'backend.catalog.categories.update' : 'backend.catalog.categories.store', $category) }}" method="post"  class="mt-6 space-y-6">
                        @csrf
                        @method($category->exists ? 'put' : 'post')

                    <div class="m-0w">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select class="form-select tomselect @error('categorie') is-invalid @enderror" aria-label="category_id"
                                id="category_id" name="category_id">
                            <option value=""> Aucune catégorie </option>
                            @foreach($categories_list as $category_list)
                                @if($category_list->id != $category->id)
                                <option @if($category_list->id == old('category_id')) selected @endif @if($category_list->id == $category->category_id) selected @endif value="{{ $category_list->id }}"> {{ $category_list->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('categorie')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nom <span class="small text-danger">*</span></label>
                                <input id="name" type="text" name="name"
                                       class="@error('name') is-invalid @enderror form-control" required
                                       value="{{ old('name', $category->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-control-label" for="slug">Slug</label>
                                <input id="slug" type="text" name="slug" disabled
                                       class="@error('slug') is-invalid @enderror form-control"
                                       value="{{ $category->slug }}">
                                @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.catalog.categories.index') }}'">
                            <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                        </button>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                            @if($category->exists)
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

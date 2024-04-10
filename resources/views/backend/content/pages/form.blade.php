@extends('backend.layouts.layout')
@section('title', $pages->exists ? __('Modifier une page') : __('Créer une page'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> @if($pages->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'une page</h6>
                </div>

                <div class="card-body">

                    <form action="{{ route($pages->exists ? 'backend.content.pages.update' : 'backend.content.pages.store', $pages) }}" method="post"  class="mt-6 space-y-6">
                        @csrf
                        @method($pages->exists ? 'put' : 'post')

                        <div class="m-0w">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="form-select tomselect @error('categorie') is-invalid @enderror" aria-label="category_id"
                                    id="category_id" name="category_id">
                                <option value=""> Aucune catégorie </option>
                                @foreach($categories_list as $category_list)
                                    <option @if($category_list->id == $pages->category_id) selected @endif value="{{ $category_list->id }}"> {{ $category_list->name }}</option>
                                @endforeach
                            </select>
                            @error('categorie')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="title">Nom <span class="small text-danger">*</span></label>
                                    <input id="title" type="text" name="title"
                                           class="@error('title') is-invalid @enderror form-control" required
                                           value="{{ old('title', $pages->title) }}">
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
                                           value="{{ $pages->slug }}">
                                    @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="m-0w">
                            <div class="form-group">
                                <label class="form-control-label" for="description">Description <span class="small text-danger">*</span></label>
                                <textarea name="description" id="description" class="@error('description') is-invalid @enderror form-control" required>{{ old('description', $pages->description) }}</textarea>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <textarea id="content" name="content" class="summernote">{{ old('content', $pages->content) }}</textarea>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.content.pages.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($pages->exists)
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

@extends('backend.layouts.layout')
@section('title', $slide->exists ? __('Modifier une image') : __('Créer une image'))

@section('main-content')

    <div class="row m-2">
        <div class="col">
            <div class="card border-left-primary shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        @if($slide->exists)
                            Modification
                        @else
                            Création
                        @endif
                        d'une image</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route($slide->exists ? 'backend.content.carrousel.update' : 'backend.content.carrousel.store', $slide) }}" method="post"  class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method($slide->exists ? 'put' : 'post')

                        @if($slide->exists)
                            <div class="text-center mb-3">
                                <img style="max-height: 150px;" src="/storage/upload/content/carousel/{{ $slide->image }}" alt="{{ $slide->name }}">
                            </div>
                    @endif

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nom <span class="small text-danger">*</span> : </label>
                                    <input id="name" type="text" name="name"
                                           class="@error('name') is-invalid @enderror form-control" required
                                           value="{{ old('name', $slide->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="image">
                                        @if($slide->exists)
                                            Changer l'image :
                                        @else
                                            Image <span class="small text-danger">*</span> :
                                        @endif
                                    </label>
                                    <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror form-control" value="{{ old('image' ) }}"></input>
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="description">Description :</label>
                            <input type="text" name="description" id="description" class="@error('description') is-invalid @enderror form-control" value="{{ old('description', $slide->description) }}"></input>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="url">Lien :</label>
                                    <input type="text" name="url" id="url" class="@error('url') is-invalid @enderror form-control" value="{{ old('url', $slide->url) }}"></input>
                                    @error('url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="title_url">Bouton :</label>
                                    <input type="text" name="title_url" id="title_url" class="@error('title_url') is-invalid @enderror form-control" value="{{ old('title_url', $slide->title_url) }}"></input>
                                    @error('title_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button type='button' class="btn btn-danger" onclick="location.href='{{ route('backend.content.carrousel.index') }}'">
                                <i class="fa-solid fa-rotate-left"></i>&nbsp;Annuler
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i>
                                @if($slide->exists)
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

@endsection
